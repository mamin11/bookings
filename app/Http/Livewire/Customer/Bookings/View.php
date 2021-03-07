<?php

namespace App\Http\Livewire\Customer\Bookings;

use App\Appointment;
use Livewire\Component;
use App\User_appointment;
use Illuminate\Support\Facades\Auth;

class View extends Component
{

    public $upcomingBookings;
    public $pastBookings;
    public $cancelledBookings;

    
    public $bookingViewOptions = [
        'upcoming' => true,
        'past' => false,
        'cancelled' => false,
    ];

    public $confirmingID;
    public $confirmCancelID;

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
        $this->upcomingBookings = Appointment::where('start_at', '>=', $date)->where('cancelled', 1)->where('customer_id', Auth::user()->user_id)->get();
        $this->pastBookings = Appointment::where('start_at', '<=', $date)->where('cancelled', 1)->where('customer_id', Auth::user()->user_id)->get();
        $this->cancelledBookings = Appointment::where('cancelled', 0)->where('customer_id', Auth::user()->user_id)->get();

    }

    public function render()
    {
        return view('livewire.customer.bookings.view');
    }
}
