<?php

namespace App\Http\Livewire\Bookings;

use App\Appointment;
use Livewire\Component;

class View extends Component
{

    //load these from db and pass to view
    //$upcomingBookings
    //$pastBookings
    //$cancelledBookings

    public $formComponents = [
        'showBookingDetails' => false,
        'editBooking' => false,
        'deleteBooking' => false,
    ];

    public $bookingViewOptions = [
        'upcoming' => true,
        'past' => false,
        'cancelled' => false,
    ];

    public function toggleComponent($comp)
    {
        if($comp === 'showBookingDetails'){
            $this->formComponents[$comp] = true;
            
            $this->formComponents['editBooking'] = false;
            $this->formComponents['deleteBooking'] = false;
        }
        else if($comp === 'editBooking') {
            $this->formComponents[$comp] = true;
            
            $this->formComponents['showBookingDetails'] = false;
            $this->formComponents['deleteBooking'] = false;
        }
        else if($comp === 'deleteBooking') {
            $this->formComponents[$comp] = true;
            
            $this->formComponents['showBookingDetails'] = false;
            $this->formComponents['editBooking'] = false;
        }
    }

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

    public function render()
    {
        $date = date("Y-m-d H:i:s");
        $upcomingBookings = Appointment::where('start_at', '>=', $date)->get();
        $pastBookings = Appointment::where('start_at', '<=', $date)->get();
        $cancelledBookings = [];
        return view('livewire.bookings.view', [
            'upcomingBookings' => $upcomingBookings,
            'pastBookings' => $pastBookings,
            'cancelledBookings' => $cancelledBookings,
        ]);
    }
}
