<?php

namespace App\Http\Livewire\Invoices;

use App\Invoice;
use App\Appointment;
use Livewire\Component;
use App\User_appointment;
use App\Mail\BookingPaymentReminder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Invoice as ld;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class View extends Component
{
    public $allInvoices;
    public $paidInvoices;
    public $unPaidInvoices;

    public $invoiceViewOptions = [
        'all' => true,
        'unpaid' => false,
        'paid' => false
    ];

    public $confirmingID;
    public $confirmingCancelID;
    public $selectedInvoice;
    public $selectedInvoiceBooking;
    
    public $reminderSent = false;

    public $showingInvoices;

    public function mount() {
        if(Auth::user()->role_id === 3)  {
            $this->allInvoices = Invoice::where('customer_id', Auth::user()->user_id)->get();
            $this->paidInvoices = Invoice::where('paid', 0)->where('customer_id', Auth::user()->user_id)->get();
            $this->unPaidInvoices = Invoice::where('paid', 1)->where('customer_id', Auth::user()->user_id)->get();
        } else {
            $this->allInvoices = Invoice::all();
            $this->paidInvoices = Invoice::where('paid', 0)->get();
            $this->unPaidInvoices = Invoice::where('paid', 1)->get();
        }
    }

    public function toggleInvoiceComponents($option) {

        if($option === 'all'){
            $this->invoiceViewOptions[$option] = true;
            
            $this->invoiceViewOptions['unpaid'] = false;
            $this->invoiceViewOptions['paid'] = false;
        }
        else if($option === 'paid') {
            $this->invoiceViewOptions[$option] = true;
            
            $this->invoiceViewOptions['all'] = false;
            $this->invoiceViewOptions['unpaid'] = false;

        }
        else if($option === 'unpaid') {
            $this->invoiceViewOptions[$option] = true;
            
            $this->invoiceViewOptions['all'] = false;
            $this->invoiceViewOptions['paid'] = false;

        }
        //reset sure button to cancel when components change
        $this->confirmingCancelID = null;
        $this->reminderSent = false;
    }

    public function showSelectedInvoice($id) {
        $this->selectedInvoice = Invoice::where('id', $id)->first();
        $this->confirmingID = $this->selectedInvoice->id;

        $this->selectedInvoiceBooking = Appointment::where('appointment_id', $this->selectedInvoice->booking_id)->first();

    }

    public function payNow($id) {
        //redirect user to checkout with $id 
        if(Auth::user()->role_id !== 3) {
            return $this->sendReminder($id);
        }
        return redirect()->route('customerCheckout', ['id' => $id]);
    }

    public function confirmCancel($id) {
        $this->confirmingCancelID = $id;
    }

    public function cancelNow($id){
        //confirm action
        //delete invoice, appointment and user appointment from db
        $invoice = Invoice::where('id', $id)->first();
        if($invoice->booking_id){
            $booking = Appointment::where('appointment_id', $invoice->booking_id)->first();
                if($booking) {
                    $user_appointment = User_appointment::where('appointment_id', $booking->appointment_id)->first();
                }
        } else {
            $booking = null;
            $invoice = null;
            $user_appointment = null;
        }
        
        if($invoice && $booking && $user_appointment) {
            Invoice::destroy($invoice->id);
            Appointment::destroy($booking->appointment_id);
            User_appointment::destroy($user_appointment->user_appointment_id);
            
            return redirect()->route('viewInvoices');
        } else {
            Invoice::destroy($invoice->id);
            return redirect()->route('viewInvoices');
        }

    }

    public function sendReminder($id){
        $invoice = Invoice::where('id', $id)->first();
        $booking = Appointment::where('appointment_id', $invoice->booking_id)->first();

        if($invoice && $booking) {
            //change email to customer email when in production
            $this->reminderSent = true;
        Mail::to('mamindesigns@gmail.com')->send(new BookingPaymentReminder($booking));

        return redirect()->route('viewInvoices');
        } else {
            abort(500);
        }
    }

    public function render()
    {
        return view('livewire.invoices.view');
    }
}
