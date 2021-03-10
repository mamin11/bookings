<?php

namespace App\Http\Controllers;

use App\User;
use App\Invoice;
use App\Appointment;
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
        $customer = User::where('user_id', Auth::user()->user_id)->first();

        //check if the invoice belongs to logged in user
        if($invoice->getCustomer()->user_id !== Auth::user()->user_id || $invoice->paid == 0) {
            return redirect('/dashboard');
            //check if the invoice is paid for
            //redirect back
        }

        return view('checkout')->with([
            'customer' => $customer,
            'invoice' => $invoice
        ]);
    }
    public function checkoutsubmit(Request $request) {
        // dd('checkout page here');
        $invoice = Invoice::where('id', $request->invoice_id)->first();
        $booking = Appointment::where('appointment_id', $invoice->booking_id)->first();

        // dd($request->all());
        // return view('checkout');
        try {
            $cahrge = Stripe::charges()->create([
                'amount' => $booking->getTotalPrice(),
                'currency' => 'GBP',
                'source' => $request->stripeToken,
                'description' => 'Booking Payment',
                'receipt_email' => Auth::user()->email,
                'metadata' => [
                    'service' => $booking->getService()->name,
                    'Date' => $booking->start_at,
                    'Duration' => $booking->getDuration(),
                    'Staff' => $booking->getStaff()->name
                ],
            ]);

            //change the invoice to paid. new val should be 0. default is 1
            $invoice->paid = 0;
            $invoice->save();

            //change booking reserved status to 0. 1 is default 
            $booking->reserved = 0;
            $booking->save();

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
