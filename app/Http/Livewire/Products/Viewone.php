<?php

namespace App\Http\Livewire\Products;

use App\Product;
use Livewire\Component;
use Darryldecode\Cart\Cart;
use Illuminate\Support\Facades\Auth;

class Viewone extends Component
{
    public $product;
    public $similar;
    public function mount($id) {
        $this->product = Product::where('product_id', $id)->first();
        $this->similar = Product::inRandomOrder()->where('product_id', '!=', $this->product->product_id)->orWhere('category_id', $this->product->category_id)->orWhere('material_id', $this->product->material_id)->orWhere('size_id', $this->product->size_id)->get()->take(4);
    }

    public function render()
    {
        return view('livewire.products.viewone');
    }
}
