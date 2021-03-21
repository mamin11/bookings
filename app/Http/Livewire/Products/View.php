<?php

namespace App\Http\Livewire\Products;

use App\Product;
use App\Product_size;
use App\Product_image;
use Livewire\Component;
use App\Product_category;
use App\Product_material;
use Livewire\WithFileUploads;

class View extends Component
{
    use WithFileUploads;

    public $categories;
    public $sizes;
    public $materials;
    public $images = [];
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

    public function mount() {
        $this->categories = Product_category::all();
        $this->sizes = Product_size::all();
        $this->materials = Product_material::all();
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

    public function updatePreview() {
        $this->priceAdded();
        $this->mount();
    }

    public function addProduct() {

        //validate the data
        $validatedData = $this->validate($this->rules, $this->customMessages);

        //add the data
        $product = Product::create([
            'name' => $this->productData['name'],
            'description' => $this->productData['description'],
            'price' => $this->productData['price'],
            'quantity' => $this->productData['quantity'],
            'material_id' => $this->productData['material'],
            'category_id' => $this->productData['category'],
            'size_id' => $this->productData['size']
        ]);

        //handle the images
        $fileName = time();
        $counter = 0;
        //validate the image if there is an image
        if($this->images) {
            $this->validate([
                'images.*' => 'image|max:5120', // 5MB Max
            ]);

            //upload the image
            foreach ($this->images as $image) {
                $image->storePubliclyAs('products', $fileName.'-'.$product->product_id.'-'.$counter, 's3');

                //create the images in db
                Product_image::create([
                    'name' => $fileName.'-'.$product->product_id.'-'.$counter,
                    'is_main' => $counter == 0 ? 0 : 1,
                    'product_id' => $product->product_id
                ]);
                $counter++;
            }

        }

        //refresh the page
        return redirect()->route('products');
    }

    public function render()
    {
        return view('livewire.products.view');
    }
}
