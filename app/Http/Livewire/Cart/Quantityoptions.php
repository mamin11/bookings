<?php

namespace App\Http\Livewire\Cart;

use App\Product;
use Livewire\Component;
use Darryldecode\Cart\Cart;
use Illuminate\Support\Facades\Auth;

class Quantityoptions extends Component
{

    public $quantity;
    public $rowID;
    public $product;

    public function mount($rowID) {
        $this->rowID = $rowID;
        
        \Cart::session(Auth::user()->user_id);
        $item = \Cart::get($this->rowID);
        $this->quantity = $item->quantity;
        $this->product = Product::where('product_id', $item->associatedModel->product_id)->first();
    }

    public function updateResult() {
        $this->resetPage();
    }

    public function increaseItems() {
        $this->quantity++;
        // update the item on cart
        \Cart::session(Auth::user()->user_id);
        $item = \Cart::get($this->rowID);
        \Cart::session(Auth::user()->user_id)->update($this->rowID,[
            'quantity' => $item->quantity++,
            'price' => $this->product->price,
        ]);
        
        return redirect()->route('cart');
    }
    
    public function decreaseItems() {
        $this->quantity--;
        // update the item on cart
        \Cart::session(Auth::user()->user_id);
        $item = \Cart::get($this->rowID);
        \Cart::session(Auth::user()->user_id)->update($this->rowID,[
            'quantity' => $item->quantity--,
            'price' => $this->product->price,
        ]);

        //destroy cart if item quantity is 0 or less
        if($item->quantity <=0) {
            \Cart::session(Auth::user()->user_id)->remove($this->rowID);
        }
        
        return redirect()->route('cart');
    }

    public function render()
    {
        return view('livewire.cart.quantityoptions');
    }
}
