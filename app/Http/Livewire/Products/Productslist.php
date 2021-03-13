<?php

namespace App\Http\Livewire\Products;

use App\Product;
use App\Product_size;
use App\Product_image;
use Livewire\Component;
use App\Product_category;
use App\Product_material;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Productslist extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $search = '';
    public $paginateNum = 10;

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

    public function mount() {
        $this->categories = Product_category::all();
        $this->sizes = Product_size::all();
        $this->materials = Product_material::all();
    }

    public function updateResult() {
        $this->resetPage();
    }

    public function delete($id) {
        //find the product
        $product = Product::where('product_id', $id)->first();

        //delete the product images
        $productimages = Product_image::where('product_id', $product->product_id)->get();
        if($productimages){
            foreach ($productimages as $image) {
                Product_image::destroy($image->id);
                //s3
                Storage::disk('s3')->delete('products/'.$image->name);

            }
        }

        //delete the product
        Product::destroy($product->product_id);

        return redirect()->route('productslist');

    }

    public function edit($id) {
        return redirect()->route('productedit', ['id' => $id]);
    }

    public function render()
    {
        return view('livewire.products.productslist', [
            'products' => Product::where('name', 'like', '%'.$this->search.'%')->paginate($this->paginateNum),
        ]);
    }
}
