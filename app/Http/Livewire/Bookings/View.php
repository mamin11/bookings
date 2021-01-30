<?php

namespace App\Http\Livewire\Bookings;

use Livewire\Component;

class View extends Component
{

    //load these from db and pass to view
    //$upcomingBookings
    //$pastBookings
    //$cancelledBookings

    public function render()
    {
        return view('livewire.bookings.view');
    }
}
