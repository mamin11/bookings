<?php

namespace App\Http\Controllers;

use App\User;
use App\Order;
use App\Product;
use App\Order_detail;
use App\Mail\NewOrder;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Cartalyst\Stripe\Exception\CardErrorException;

class HomeController extends Controller
{
    public function index() {
        $products = Product::paginate(16);
        $staff = User::inRandomOrder()->where('role_id', 2)->get()->take(3);
        return view('home', ['products' => $products, 'staff' => $staff]);
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

    public function cartcheckoutview() {
        \Cart::session(Auth::user()->user_id);
        $items = \Cart::session(Auth::user()->user_id)->getContent();

        if((count($items) > 0)){
            $subTotal = \Cart::session(Auth::user()->user_id)->getSubTotal();
            return view('cartcheckout')->with(['items' => $items, 'total' => $subTotal, 'shipping' => $this->getCartShippingCost()]);
        } else {
            return redirect('/');
        }
    }

    public function getCartShippingCost(){
        \Cart::session(Auth::user()->user_id);
        $items = \Cart::getContent();
        $shippingCost = 0;
        foreach ($items as $item) {
            $shippingCost += $item->attributes->shipping;
        }
        return $shippingCost;
    }

    public function cartcheckoutpost(Request $request) {
        $cartContents = \Cart::session(Auth::user()->user_id)->getContent();
        // $order = Order::where('order_id', $request->order_id)->first();

        if( (count($cartContents) > 0)){
            $currentOrderID = 0;

            try {
                $total = $request->total + $request->shipping;
                //set up payment intent
                $paymentIntent = Stripe::paymentIntents()->create([
                    'amount' => ($total),
                    'currency' => 'GBP',
                    'payment_method_types' => [
                        'card',
                    ]
                ]);

                //create order
                $subTotal = \Cart::session(Auth::user()->user_id)->getSubTotal();
                $orderTotal = $subTotal + $this->getCartShippingCost();
                $orderID =  $this->createOrder($orderTotal);
                $currentOrderID = $orderID;

                $charge = Stripe::charges()->create([
                    'amount' => $total,
                    'currency' => 'GBP',
                    'source' => $request->stripeToken,
                    'description' => 'Product purchase',
                    'receipt_email' => Auth::user()->email,
                    'metadata' => [
                        'order_id' => $orderID,
                    ],
                ]);
                
                //send email to customer
                $order = Order::where('order_id', $orderID)->first();
                $this->sendCustomerReceipt($order);

                //destroy cart
                \Cart::session(Auth::user()->user_id)->clear();

                // return back()->with('success_message', 'Payment Successfully recieved');
                return redirect()->route('checkout-success')->with('success_message', 'Payment Successfully recieved');
            } catch (CardErrorException $e) {
                //remove the order data
                $order_details = Order_detail::where('order_id', $currentOrderID)->get();
                foreach ($order_details as $orderD) {
                    Order_detail::destroy($orderD->order_details_id);
                }
                Order::destroy($currentOrderID);

                return back()->withErrors('Error! '.$e->getMessage());
            }
        } else {
            return redirect('/');
        }
    }

    public function createOrder($total) {

        \Cart::session(Auth::user()->user_id);
        $items = \Cart::getContent();

        $previousOrderNum = Order::latest()->first() ? Order::latest()->first()->order_number : 999;
        $order = Order::create([
            'order_number' => $previousOrderNum+1,
            'customer_id' => Auth::user()->user_id,
            'total' => $total,
            'paid' => 0
        ]);

        //populate order details table with products
        foreach ($items as $item) {
            Order_detail::create([
                'order_id' => $order->order_id,
                'product_id' => $item->associatedModel->product_id,
                'product_quantity' => $item->quantity
            ]);
        }

        return $order->order_id;
    }

    public function sendCustomerReceipt($order) {
         //change email to customer email when in production
        Mail::to('mamindesigns@gmail.com')->send(new NewOrder($order));
    }

    public function checkOutSuccess() {
        if(! session()->has('success_message')) {
            return redirect('/');
        }

        return view('checkout-success');
    }
}
