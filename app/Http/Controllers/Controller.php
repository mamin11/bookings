<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Cartalyst\Stripe\Exception\CardErrorException;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function checkout($id) {
        // dd('checkout page here');
        //get invoice using id
        $invoice = Invoice::where('id', $id)->first();

        //check if the invoice belongs to logged in user
        if($invoice->getCustomer()->user_id !== Auth::user()->user_id) {
            return redirect('/dashboard');
            //check if the invoice is paid for
            //redirect back
        }

        return view('checkout');
    }
    public function checkoutsubmit(Request $request) {
        // dd('checkout page here');
        dd($request->all());
        // return view('checkout');
        try {
            $cahrge = Stripe::charges()->create([
                'amount' => 300,
                'currency' => 'GBP',
                'source' => $request->stripeToken,
                'description' => 'Booking Payment',
                'receipt_email' => 'mamindesigns@gmail.com',
                'metadata' => [

                ],
            ]);

            return redirect()->route('payment-successfull')->with('success_message', 'Payment Successfully recieved');
        } catch (CardErrorException $e) {
            return back()->withErrors('Error! '.$e->getMessage());
        }
    }

    public function success() {
        if(! session()->has('success_message')) {
            return redirect('/dashboard');
        }

        return view('payment-success');
    }
}
