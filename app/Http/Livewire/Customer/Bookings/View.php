<?php

namespace App\Http\Livewire\Customer\Bookings;

use App\Appointment;
use Livewire\Component;
use App\User_appointment;
use App\Mail\RequestCancellation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\RequestCancellationCustomer;

class View extends Component
{

    public $upcomingBookings;
    public $pastBookings;
    public $cancelledBookings;

    public $selectedBooking;
    public $bookingData = [];

    public $cancellationMessage;

    public $confirmationData = [
        'customer' => '',
        'service' => '',
        'staff' => '',
        'duration' => '',
        'price' => '',
        'date' => '',
        'start_time' => '',
        'end_time' => '',
    ];

    public $showAddComment = false;
    
    public $bookingViewOptions = [
        'upcoming' => true,
        'past' => false,
        'cancelled' => false,
    ];

    public $confirmingID;

    public function toggleBookingComponents($option)
    {
        if($option === 'upcoming'){
            $this->bookingViewOptions[$option] = true;
            
            $this->bookingViewOptions['past'] = false;
            $this->bookingViewOptions['cancelled'] = false;
        }
        else if($option === 'past') {
            $this->bookingViewOptions[$option] = true;
            
            $this->bookingViewOptions['upcoming'] = false;
            $this->bookingViewOptions['cancelled'] = false;

        }
        else if($option === 'cancelled') {
            $this->bookingViewOptions[$option] = true;
            
            $this->bookingViewOptions['upcoming'] = false;
            $this->bookingViewOptions['past'] = false;

        }
    }


    public function mount() {
        $date = date("Y-m-d H:i:s");
        $this->upcomingBookings = Appointment::where('start_at', '>=', $date)->where(['cancelled' => 1, 'status' => 1, 'customer_id' => Auth::user()->user_id])->get();
        $this->pastBookings = Appointment::where('start_at', '<=', $date)->where(['cancelled' => 1, 'status' => 1, 'customer_id' => Auth::user()->user_id])->get();
        $this->cancelledBookings = Appointment::where('cancelled', 0)->where('customer_id', Auth::user()->user_id)->get();

    }

    public function showSelectedBooking($id) {
        $this->selectedBooking = Appointment::where('appointment_id', $id)->first();
        $this->confirmingID = $this->selectedBooking->appointment_id;
        $this->showAddComment = false;
        
    }

    public function requestCancellation() {
        $this->showAddComment = true;
        //validate the message 
        $customMessage = [
            'required' => 'Please add reason for cancellation'
        ];
        $this->cancellationMessage;
        $rules = [
            'cancellationMessage' => 'required',
        ];

        //validate
        $validatedData = $this->validate($rules, $customMessage);

        //create cancellation request
        //set appointment status to 0 and create a message
        $this->selectedBooking->status = 0;
        $this->selectedBooking->save();
        Mail::to('mamindesigns@gmail.com')->send(new RequestCancellation($this->selectedBooking, $this->cancellationMessage));

        //email to customers will work once aws ses is in production mode
        //Mail::to(Auth::user()->email)->send(new RequestCancellationCustomer($this->selectedBooking, $this->cancellationMessage));
        
        //refresh page
        return redirect()->route('mybookings');

    }

    public function render()
    {
        return view('livewire.customer.bookings.view');
    }
}
