<?php

namespace App\Http\Livewire\Bookings;

use App\User;
use App\Service;
use App\Appointment;
use Livewire\Component;
use App\User_appointment;

class View extends Component
{

    //load these from db and pass to view
    public $upcomingBookings;
    public $pastBookings;
    public $cancelledBookings;

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

    public $bookingForm = [
        'service_id' => '',
        'staff_id' => '',
        'start_time' => '',
        'duration' => '',
        'customer_id' => '',
        'notifyCustomer' => 0,
        'comments' => '',
    ];

    public $showAddComment = false;

    public $confirmingID;
    public $updatingBooking;

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

    public function getDuration($end_at, $start_at) {
        $diff = strtotime($end_at) - strtotime($start_at);
        $diffH = gmdate('H:i:s ',$diff);
        $h = explode(':', $diffH)[0];
        return $h * 1;
    }

    public function cancelBooking($id) {

    }

    public function confirmCancel($id) {

    }

    public function updateBooking($id) {
        $this->formComponents['showBookingDetails'] = true;
        $this->updatingBooking = Appointment::where('appointment_id', $id)->first();
        // @dd($this->updatingBooking);
        $this->bookingForm['service_id'] = $this->updatingBooking->service_id;
        $this->bookingForm['staff_id'] = $this->updatingBooking->user_id;
        $this->bookingForm['start_time'] = $this->updatingBooking->start_at;
        $this->bookingForm['duration'] = $this->getDuration($this->updatingBooking->end_at, $this->updatingBooking->start_at);
        $this->bookingForm['customer_id'] = $this->updatingBooking->getCustomer()->user_id;
        $this->bookingForm['comments'] = $this->updatingBooking->comments;
    }

    public function updateBookingConfirm() {

    }

    public function deleteBooking($id) {

    }

    public function render()
    {
        $date = date("Y-m-d H:i:s");
        $this->upcomingBookings = Appointment::where('start_at', '>=', $date)->where('cancelled', 1)->get();
        $this->pastBookings = Appointment::where('start_at', '<=', $date)->where('cancelled', 1)->get();
        $this->cancelledBookings = Appointment::where('cancelled', 0)->get();

        $staff = User::where('role_id', 2)->get();
        $customers = User::where('role_id', 3)->paginate(10);
        $services = Service::all();
        
        return view('livewire.bookings.view', [
            'upcomingBookings' => $this->upcomingBookings,
            'pastBookings' => $this->pastBookings,
            'cancelledBookings' => $this->cancelledBookings,
            'staff' => $staff,
            'customers' => $customers,
            'services' => $services,
        ]);
    }
}
