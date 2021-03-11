<?php

namespace App\Http\Livewire\Invoices;

use App\Invoice;
use App\Appointment;
use Livewire\Component;
use App\User_appointment;
use Illuminate\Support\Facades\Auth;
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
    }

    public function showSelectedInvoice($id) {
        $this->selectedInvoice = Invoice::where('id', $id)->first();
        $this->confirmingID = $this->selectedInvoice->id;

        $this->selectedInvoiceBooking = Appointment::where('appointment_id', $this->selectedInvoice->booking_id)->first();
        
        // $newBuyer = new Buyer([
        //     'name' => $this->selectedInvoice->getCustomer()->name,
        //     'custom_fields' => [
        //         'email' => $this->selectedInvoice->getCustomer()->email,
        //     ]
        // ]);

        // $item = (new InvoiceItem())
        // ->title($booking->getService()->name)
        // ->pricePerUnit($booking->getServicePrice())
        // ->quantity($booking->getDuration());

        // if($this->selectedInvoice->paid == 0){
        //     $invoice = ld::make('Receipt')
        //     ->buyer($newBuyer)
        //     ->date($this->selectedInvoice->created_at)
        //     ->payUntilDays(1)
        //     ->notes('We have received your payment. Your booking is now officially confirmed.')
        //     ->filename($this->selectedInvoice->getCustomer()->name. '-' .$this->selectedInvoice->created_at)
        //     ->addItem($item);
        // }
        // $invoice = ld::make('Invoice')
        // ->buyer($newBuyer)
        // ->date($this->selectedInvoice->created_at)
        // ->payUntilDays(1)
        // ->notes('We have received your payment. Your booking is now officially confirmed.')
        // ->filename($this->selectedInvoice->getCustomer()->name. '-' .$this->selectedInvoice->created_at)
        // ->addItem($item);

        // $invoice->stream();
        // $link = $invoice->url();

        // if the invoice already exists, retrieve from storage
        //else create the invoice and store in s3, then display it
        // $visibility = Storage::disk('s3')->getVisibility('invoices/'.$this->selectedInvoice->getCustomer()->name. '-' .$this->selectedInvoice->created_at);
        // $visibility = Storage::disk('s3')->setVisibility('invoices/'.$this->selectedInvoice->getCustomer()->name. '-' .$this->selectedInvoice->created_at, 'public');
        // $this->showingInvoices = Storage::disk('s3')->url('invoices/'.$this->selectedInvoice->getCustomer()->name. '-' .$this->selectedInvoice->created_at);

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
        $booking = Appointment::where('appointment_id', $invoice->booking_id)->first();
        $user_appointment = User_appointment::where('appointment_id', $booking->appointment_id)->first();
        
        if($invoice && $booking && $user_appointment) {
            Invoice::destroy($invoice->id);
            Appointment::destroy($booking->appointment_id);
            User_appointment::destroy($user_appointment->user_appointment_id);

            return redirect()->route('viewInvoices');
        }

    }

    public function sendReminder($id){
        dd('reminder clicked');
    }

    public function render()
    {
        return view('livewire.invoices.view');
    }
}
