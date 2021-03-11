<?php

namespace App\Http\Controllers;

use App\User;
use App\Invoice;
use App\Appointment;
use Illuminate\Http\Request;
use App\Mail\BookingPaymentReceipt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use LaravelDaily\Invoices\Classes\Buyer;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Foundation\Bus\DispatchesJobs;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Invoice as ld;
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
        if($invoice) {
            $booking = Appointment::where('appointment_id', $invoice->booking_id)->first();
            $customer = User::where('user_id', Auth::user()->user_id)->first();
        } else {
            return redirect('/dashboard');
        }

        //check if the invoice belongs to logged in user
        if($invoice->getCustomer()->user_id !== Auth::user()->user_id || $invoice->paid == 0) {
            return redirect('/dashboard');
            //check if the invoice is paid for
            //redirect back
        }


        return view('checkout')->with([
            'customer' => $customer,
            'invoice' => $invoice,
            // 'paymentIntent' => $paymentIntent['id']
        ]);
    }
    public function checkoutsubmit(Request $request) {
        // dd('checkout page here');
        $invoice = Invoice::where('id', $request->invoice_id)->first();
        $booking = Appointment::where('appointment_id', $invoice->booking_id)->first();

        try {

            //set up payment intent
            $paymentIntent = Stripe::paymentIntents()->create([
                'amount' => $booking->getTotalPrice(),
                'currency' => 'GBP',
                'payment_method_types' => [
                    'card',
                ]
            ]);

            // $paymentIntentconfirm = Stripe::paymentIntents()->confirm($paymentIntent['id'],[
            //     'return_url' => 'http://127.0.0.1:8000/checkout/'.$request->invoice_id,
            //     'payment_method' => 'pm_card_visa',
            // ]);

            $charge = Stripe::charges()->create([
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

            //send receipt email
            $this->sendReceipt($invoice, $booking);

            return redirect()->route('payment-successfull')->with('success_message', 'Payment Successfully recieved');
        } catch (CardErrorException $e) {
            return back()->withErrors('Error! '.$e->getMessage());
        }
    }

    public function sendReceipt($invoice, $booking) {
        $newBuyer = new Buyer([
            'name' => Auth::user()->name,
            'custom_fields' => [
                'email' => Auth::user()->email,
            ]
        ]);

        $item = (new InvoiceItem())
        ->title($booking->getService()->name)
        ->pricePerUnit($booking->getServicePrice())
        ->quantity($booking->getDuration());

        $invoice = ld::make('Receipt')
        ->buyer($newBuyer)
        ->date($invoice->created_at)
        ->payUntilDays(1)
        ->notes('We have received your payment. Your booking is now officially confirmed.')
        ->filename(Auth::user()->name. '-' .$invoice->created_at)
        ->addItem($item)
        ->save('s3');

        $link = $invoice->url();
        //change email to customer email when in production
        Mail::to('mamindesigns@gmail.com')->send(new BookingPaymentReceipt($booking, $link));
    }

    public function success() {
        if(! session()->has('success_message')) {
            return redirect('/dashboard');
        }

        return view('payment-success');
    }
}
