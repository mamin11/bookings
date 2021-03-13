<?php

namespace App\Http\Livewire\Products;

use App\Product;
use App\Product_size;
use App\Product_image;
use Livewire\Component;
use App\Product_category;
use App\Product_material;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
    use WithFileUploads;
    
    public $product;
    public $images = [];
    public $mainImg;
    public $productData = [
        'name' => '',
        'description' => '',
        'price' => '',
        'quantity' => '',
        'material' => '',
        'size' => '',
        'category' => ''
    ];

    public $selectedCategory;
    public $selectedMaterial;
    public $selectedSize;
    public $productFinalPrice;

    public $categories;
    public $sizes;
    public $materials;

    //custom validation messages
    private $customMessages = [
        'required' => 'This field must be filled in',
        'unique' => 'This already exists in the database',
        'string' => 'This needs to be a string',
        'integer' => 'This needs to be a number',
        'min' => 'You must select at least :min from the checkbox',
        'image' => 'Please select an image',
        'max' => 'This exceeds the maximum size allowed'
    ];

    //rules
    private $rules = [
        'productData.name' => 'required',
        'productData.description' => 'required',
        'productData.price' => 'required|integer|min:1',
        'productData.quantity' => 'required|integer|min:1|max:999',
        'productData.material' => 'required|integer',
        'productData.size' => 'required|integer',
        'productData.category' => 'required|integer',
    ];

    public function mount($id) {
        $this->product = Product::where('product_id', $id)->first();
        $this->categories = Product_category::all();
        $this->sizes = Product_size::all();
        $this->materials = Product_material::all();

        $this->productData['name'] = $this->productData['name'] ? $this->productData['name'] : $this->product->name;
        $this->productData['description'] = $this->productData['description'] ? $this->productData['description'] : $this->product->description;
        $this->productData['price'] = $this->productData['price'] ? $this->productData['price'] : $this->product->price;
        $this->productData['quantity'] = $this->productData['quantity'] ? $this->productData['quantity'] : $this->product->quantity;
        $this->productData['material'] = $this->productData['material'] ? $this->productData['material'] : $this->product->material_id;
        $this->productData['size'] = $this->productData['size'] ? $this->productData['size'] : $this->product->size_id;
        $this->productData['category'] = $this->productData['category'] ? $this->productData['category'] :  $this->product->category_id;
    }

    public function categorySelected() {
        if($this->productData['category'] !== '') {
            $this->selectedCategory = Product_category::where('category_id', $this->productData['category'])->first();
        }
        $this->priceAdded();
    }
    
    public function materialSelected() {
        if($this->productData['material']) {
            $this->selectedMaterial = Product_material::where('material_id', $this->productData['material'])->first();
        }
        $this->priceAdded();
    }
    
    public function sizeSelected() {
        if($this->productData['size']) {
            $this->selectedSize = Product_size::where('size_id', $this->productData['size'])->first();
        }
        $this->priceAdded();
    }

    public function priceAdded() {
        if($this->selectedCategory && $this->selectedMaterial && $this->selectedSize) {
            $this->productFinalPrice = ($this->productData['price'] + $this->selectedCategory->extra_cost + $this->selectedMaterial->extra_price_on_product + $this->selectedSize->extra_price_on_product);
        } else {
            $this->productFinalPrice = $this->productData['price'];
        }
    }

    public function update() {
        //validate the data
        $validatedData = $this->validate($this->rules, $this->customMessages);

        $this->product->name= $this->productData['name'] ? $this->productData['name'] : $this->product->name;
        $this->product->description = $this->productData['description'] ? $this->productData['description'] : $this->product->description;
        $this->product->price = $this->productData['price'] ? $this->productData['price'] : $this->product->price;
        $this->product->quantity = $this->productData['quantity'] ? $this->productData['quantity'] : $this->product->quantity;
        $this->product->material_id = $this->productData['material'] ? $this->productData['material'] : $this->product->material_id;
        $this->product->size_id = $this->productData['size'] ? $this->productData['size'] : $this->product->size_id;
        $this->product->category_id = $this->productData['category'] ? $this->productData['category'] :  $this->product->category_id;



        //if new images were selected
        if($this->images) {
            $fileName = time();
            $counter = 0;
                $this->validate([
                    'images.*' => 'image|max:5120', // 5MB Max
                ]);

                $productImages = Product_image::where('product_id', $this->product->product_id)->get();
                //delete the original images ******* from DB ******
                    foreach ($productImages as $img) {
                        Product_image::destroy($img->id);

                        //delete the original images ******* from S3 ******
                        Storage::disk('s3')->delete('products/'.$img->name);
                    }
    
                //upload the image
                foreach ($this->images as $image) {
                    $image->storePubliclyAs('products', $fileName.'-'.$this->product->product_id.'-'.$counter, 's3');
    
                    //create the images in db
                    Product_image::create([
                        'name' => $fileName.'-'.$this->product->product_id.'-'.$counter,
                        'is_main' => $counter == 0 ? 0 : 1,
                        'product_id' => $this->product->product_id
                    ]);
                    $counter++;
                }

            }

            $this->product->save();
            return redirect()->route('productslist');

    }
    public function render()
    {
        return view('livewire.products.edit');
    }
}
