<?php

namespace App\Http\Controllers;

use App\Product;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {
        $products = Product::paginate(16);
        return view('home', ['products' => $products]);
    }

    public function cart() {
        // \Cart::session(Auth::user()->user_id)->clear();
        \Cart::session(Auth::user()->user_id);
        $items = \Cart::getContent();
        $subTotal = \Cart::session(Auth::user()->user_id)->getSubTotal();
        $shippingCost = 0;
        foreach ($items as $item) {
            $shippingCost += $item->attributes->shipping;
        }

        return view('cart')->with(['items' => $items, 'total' => $subTotal, 'shippingCost' => $shippingCost]);
    }

    public function addToCart(Request $request) {
        $product = Product::where('product_id', $request->input('id'))->first();
        $uniqID = uniqid();
        
        \Cart::session(Auth::user()->user_id)->add([
            'id' => $uniqID,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'attributes' => [
                'category' => $product->getCategory()->name,
                'material' => $product->getMaterial()->name,
                'size' => $product->getSize()->name,
                'shipping' => $product->getShippingCost()
            ],
            'associatedModel' => $product
        ]);
        
        return redirect()->route('home')->with('success-message', 'Item Added to Cart');
    }

    public function removefromcart($id) {
        // dd($id);
        \Cart::session(Auth::user()->user_id);
        \Cart::session(Auth::user()->user_id)->remove($id);
        return redirect()->route('cart')->with('danger-message', 'Item removed');
    }
}
