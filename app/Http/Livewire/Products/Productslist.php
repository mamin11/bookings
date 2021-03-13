<?php

namespace App\Http\Livewire\Products;

use App\Product;
use App\Product_image;
use Livewire\Component;
use Livewire\WithPagination;

class Productslist extends Component
{
    use WithPagination;

    public $search = '';
    public $paginateNum = 10;

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
            }
        }

        //delete the product
        Product::destroy($product->product_id);

        return redirect()->route('productslist');

    }

    public function edit() {
        dd('edit btn clicked');
    }

    public function render()
    {
        return view('livewire.products.productslist', [
            'products' => Product::where('name', 'like', '%'.$this->search.'%')->paginate($this->paginateNum),
        ]);
    }
}
