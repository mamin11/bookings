<?php

namespace App\Http\Livewire\Cart;

use Livewire\Component;
use Darryldecode\Cart\Cart;
use Illuminate\Support\Facades\Auth;

class Counter extends Component
{
    public function render()
    {
        \Cart::session(Auth::user()->user_id);
        $items = \Cart::getContent();
        return view('livewire.cart.counter')->with('items', $items);
    }
}
