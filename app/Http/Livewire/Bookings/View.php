<?php

namespace App\Http\Livewire\Bookings;

use App\User;
use App\Service;
use App\Appointment;
use Livewire\Component;
use App\User_appointment;
use App\Rules\validateAppointment;

class View extends Component
{

    //load these from db and pass to view
    public $upcomingBookings;
    public $pastBookings;
    public $cancelledBookings;

    public $formComponents = [
        'showBookingDetails' => false,
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
        'end_time' => '',
        'duration' => '',
        'customer_id' => '',
        'notifyCustomer' => 0,
        'comments' => '',
    ];

    public $deleteConfirmed = false;
    public $deleteCancelled = false;

    public $showAddComment = false;

    public $confirmingID;
    public $updatingBooking;
    public $updatingBookingUserAppointment;

    //custom validation messages
    private $customMessages = [
        'required' => 'This field must be filled in',
        'unique' => 'There is another appointment starting at this time',
        'string' => 'This needs to be a string',
        'integer' => 'This needs to be a number',
        'email' => 'This must be a valid email address',
        'min' => 'You must select at least :min from the checkbox'
    ];

    public function toggleComponent($comp)
    {
        if($comp === 'showBookingDetails'){
            $this->formComponents[$comp] = true;
            
            $this->formComponents['deleteBooking'] = false;
        }
        else if($comp === 'deleteBooking') {
            $this->formComponents[$comp] = true;
            
            $this->formComponents['showBookingDetails'] = false;
        }
    }

    public function toggleBookingComponents($option)
    {
        if($option === 'upcoming'){
            $this->bookingViewOptions[$option] = true;
            
            $this->bookingViewOptions['past'] = false;
            $this->bookingViewOptions['cancelled'] = false;
            $this->formComponents['showBookingDetails'] = false;
        }
        else if($option === 'past') {
            $this->bookingViewOptions[$option] = true;
            
            $this->bookingViewOptions['upcoming'] = false;
            $this->bookingViewOptions['cancelled'] = false;
            $this->formComponents['showBookingDetails'] = false;

        }
        else if($option === 'cancelled') {
            $this->bookingViewOptions[$option] = true;
            
            $this->bookingViewOptions['upcoming'] = false;
            $this->bookingViewOptions['past'] = false;
            $this->formComponents['showBookingDetails'] = false;

        }
    }

    public function getDuration($end_at, $start_at) {
        $diff = strtotime($end_at) - strtotime($start_at);
        $diffH = gmdate('H:i:s ',$diff);
        $h = explode(':', $diffH)[0];
        return $h * 1;
    }

    public function getEndTime($start_date, $duration) {
        $durationSeconds = $duration > 1 ? $duration * 60 *60 : 0;
        $timeStamp = strtotime($start_date);
        $total = $durationSeconds + $timeStamp;
        // $endTime = date('H:i', $total);
        $endTime = date('Y-m-d H:i', $total);
        
        return $endTime;
    }

    public function getPrice($price, $duration) {
        return $price * $duration;
    }

    public function cancelBooking($id) {

    }

    public function confirmCancel($id) {

    }

    public function updateBooking($id) {
        $this->formComponents['showBookingDetails'] = true;
        $this->updatingBooking = Appointment::where('appointment_id', $id)->first();
        $this->updatingBookingUserAppointment = User_appointment::where('appointment_id', $id)->first();
        $this->bookingForm['service_id'] =$this->updatingBooking->service_id;
        $this->bookingForm['staff_id'] =  $this->updatingBooking->user_id;
        $this->bookingForm['start_time'] = $this->updatingBooking->start_at;
        $this->bookingForm['duration'] =  $this->getDuration($this->updatingBooking->end_at, $this->updatingBooking->start_at);
        $this->bookingForm['end_time'] = $this->updatingBooking->end_at ;
        $this->bookingForm['customer_id'] =  $this->updatingBooking->getCustomer()->user_id;
        $this->bookingForm['comments'] =$this->updatingBooking->comments;
        // $this->bookingForm['service_id'] = $this->bookingForm['service_id'] ? $this->bookingForm['service_id'] : $this->updatingBooking->service_id;
        // $this->bookingForm['staff_id'] = $this->bookingForm['staff_id'] ? $this->bookingForm['staff_id'] : $this->updatingBooking->user_id;
        // $this->bookingForm['start_time'] = $this->bookingForm['start_time'] ? $this->bookingForm['start_time'] : $this->updatingBooking->start_at;
        // $this->bookingForm['duration'] = $this->bookingForm['duration'] ? $this->bookingForm['duration'] : $this->getDuration($this->updatingBooking->end_at, $this->updatingBooking->start_at);
        // $this->bookingForm['end_time'] = $this->bookingForm['start_time'] ? $this->getEndTime($this->bookingForm['start_time'], $this->bookingForm['duration']) : $this->updatingBooking->end_at ;
        // $this->bookingForm['customer_id'] = $this->bookingForm['customer_id']  ? $this->bookingForm['customer_id']  : $this->updatingBooking->getCustomer()->user_id;
        // $this->bookingForm['comments'] = $this->bookingForm['comments'] ? $this->bookingForm['comments'] : $this->updatingBooking->comments;
    }

    public function updateBookingConfirm() {
        //validate
        $rules = [
            'bookingForm.staff_id' => 'required|integer',
            'bookingForm.service_id' => 'required|integer',
            'bookingForm.customer_id' => 'required|integer',
            'bookingForm.start_time' => ['required' , new validateAppointment()],
            'bookingForm.end_time' => ['required' , new validateAppointment()],
            'bookingForm.duration' => 'required|integer',
        ];

        $validatedData = $this->validate($rules, $this->customMessages);

        //update the appointment
        $this->updatingBooking->service_id = $this->bookingForm['service_id'];
        $this->updatingBooking->user_id = $this->bookingForm['staff_id'];
        $this->updatingBooking->duration = $this->bookingForm['duration'] ? $this->bookingForm['duration'] : $this->updatingBooking->duration;
        $this->updatingBooking->start_at = $this->bookingForm['start_time'] ? $this->bookingForm['start_time'] : $this->updatingBooking->start_at;
        $this->updatingBooking->end_at = $this->bookingForm['end_time'] ? $this->bookingForm['end_time'] : $this->updatingBooking->end_at;
        $this->updatingBooking->comments = $this->bookingForm['comments'] ? $this->bookingForm['comments'] : $this->updatingBooking->comments;

        //update the user appointment
        $servicePrice = Service::find( $this->bookingForm['service_id'])->first()->price;
        $this->updatingBookingUserAppointment->total_price = $this->bookingForm['service_id'] ? $this->getPrice($servicePrice, $this->bookingForm['duration']) : $this->updatingBookingUserAppointment->total_price;

        //save the appointment
        $this->updatingBooking->save();

        //save the user appointment
        $this->updatingBookingUserAppointment->save();
    }

    public function deleteBooking($id) {
        //delete the booking
        $uApID = User_appointment::where('appointment_id', $id)->first()->user_appointment_id;
        User_appointment::destroy($uApID);
        Appointment::destroy($id);
        $this->deleteConfirmed = true;
    }
    
    public function cancelDeleteBooking() {
        
        $this->deleteCancelled = true;
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
