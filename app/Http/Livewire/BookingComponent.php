<?php

namespace App\Http\Livewire;

use App\User;
use App\Service;
use App\Appointment;
use Livewire\Component;
use App\User_appointment;
use Livewire\WithPagination;

//booking component is shown when /bookings/add is visited
class BookingComponent extends Component
{

    use WithPagination;
    
    //holds data when creating booking
    public $bookingForm = [
        'service_id' => '',
        'staff_id' => '',
        'start_date' => '',
        'start_time' => '',
        // 'end_time' => '',
        'duration' => '',
        'customer_id' => '',
        'notifyCustomer' => 0,
        'comments' => '',
    ];

    public $formComponents = [
        'showBookingDetailForm' => true,
        'showCustomerDetailForm' => false,
        'showConfirmationForm' => false,
        'showNewCustomerForm' => false,
        'showExistingCustomerForm' => false,
    ];

    public $showAddComment = false;

    public $showBookingComponent = true;

    public $confirmationData = [
        'customer' => '',
        'service' => '',
        'staff' => '',
        'price' => '',
        'date' => '',
        'start_time' => '',
    ];

    public $showConfirmationDetails = false;

    //event listener
    protected $listeners = ['bookingClose'];

    //custom validation messages
    private $customMessages = [
        'required' => 'This field must be filled in',
        'unique' => 'This already exists in the database',
        'string' => 'This needs to be a string',
        'integer' => 'This needs to be a number',
        'email' => 'This must be a valid email address',
        'min' => 'You must select at least :min from the checkbox'
    ];

    public function bookingClose()
    {
        $this->showBookingComponent = !$this->showBookingComponent;
    }

    public function getDuration($end_at, $start_at) {
        $diff = strtotime($end_at) - strtotime($start_at);
        $diffH = gmdate('H:i:s ',$diff);
        $h = explode(':', $diffH)[0];
        return $h;
    }

    public function getEndTime($start_date, $duration) {
        $durationSeconds = $duration > 1 ? $duration * 60 *60 : 0;
        $timeStamp = strtotime($start_date);
        $total = $durationSeconds + $timeStamp;
        $endTime = date('H:i', $total);
        
        return $endTime;
    }

    public function getPrice($price, $duration) {
        return $price * $duration;
    }


    public function toggleComponent($comp)
    {
        if($comp === 'showBookingDetailForm'){
            $this->formComponents[$comp] = true;
            
            $this->formComponents['showCustomerDetailForm'] = false;
            $this->formComponents['showConfirmationForm'] = false;
        }
        else if($comp === 'showCustomerDetailForm') {
            $this->formComponents[$comp] = true;
            
            $this->formComponents['showBookingDetailForm'] = false;
            $this->formComponents['showConfirmationForm'] = false;
        }
        else if($comp === 'showConfirmationForm') {
            $this->formComponents[$comp] = true;
            
            $this->formComponents['showBookingDetailForm'] = false;
            $this->formComponents['showCustomerDetailForm'] = false;
        }

        //set the data for confirmation page
        if($this->formComponents['showConfirmationForm'] == true) 
        {
            // if($this->bookingForm['service_id']) {
                $this->confirmationData['staff'] = $this->bookingForm['staff_id'] ? User::find( $this->bookingForm['staff_id']) : '';
                $this->confirmationData['customer'] = $this->bookingForm['customer_id'] ? User::find( $this->bookingForm['customer_id']) : '';
                $this->confirmationData['service'] = $this->bookingForm['service_id'] ? Service::find( $this->bookingForm['service_id']) : '';
                $this->confirmationData['price'] = $this->bookingForm['duration'] ? $this->getPrice($this->confirmationData['service']['price'],$this->bookingForm['duration']) : '';
                $this->confirmationData['date'] = $this->bookingForm['start_date'];
                $this->confirmationData['start_time'] = $this->bookingForm['start_time'];
                $this->confirmationData['end_time'] = $this->getEndTime($this->confirmationData['start_time'], $this->bookingForm['duration']);
                // $this->confirmationData['time'] = $this->getDuration($this->confirmationData['service']->start_at);

                if(!empty($this->confirmationData['customer']) && !empty($this->confirmationData['staff']) && !empty($this->confirmationData['service'])) {
                    $this->showConfirmationDetails = true;
                }
        }

    }


    public function toggleCustomerStates($comp)
    {
        if($comp === 'showExistingCustomerForm'){
            $this->formComponents[$comp] = true;
            
            $this->formComponents['showNewCustomerForm'] = false;
        }
        else if($comp === 'showNewCustomerForm') {
            $this->formComponents[$comp] = true;
            
            $this->formComponents['showExistingCustomerForm'] = false;
        }

    }

    public function closeComponent()
    {
        $this->showBookingComponent = false;
    }

    public function redirectToCreateCustomer() {
        return redirect()->route('viewCustomers');
    }

    public function createBooking() 
    {
        //validate
        //rules
        $rules = [
            'bookingForm.staff_id' => 'required|integer',
            'bookingForm.service_id' => 'required|integer',
            'bookingForm.customer_id' => 'required|integer',
            'bookingForm.start_date' => 'required',
            'bookingForm.start_time' => 'required|unique:appointments,start_time',
            'bookingForm.duration' => 'required|integer',
        ];

        //validate
        $validatedData = $this->validate($rules, $this->customMessages);

        //create apointment
        $appointment_id = Appointment::insertGetId([
            'start_at' => $this->confirmationData['date'],
            'start_time' => $this->confirmationData['start_time'],
            'end_at' => $this->confirmationData['end_time'],
            'comments' => $this->showAddComment ? $this->bookingForm['comments'] : '',
            'service_id' => $this->confirmationData['service']['service_id'],
            'user_id' => $this->confirmationData['staff']['user_id']
        ]);

        //create user appointment
        $user_appointment = User_appointment::create([
            'appointment_id' => $appointment_id,
            'customer_id' => $this->confirmationData['customer']['user_id']
        ]);

        //create invoice

        //if notify customer, create notification

        //flash messages
        session()->flash('Successfully added');
        session()->flash('alert-class', 'alert-success');

        //redirect to refresh
        return redirect()->route('viewBookings');
    }
    
    public function render()
    {
        $staff = User::where('role_id', 2)->get();
        // $customers = User::search($this->searchCustomer)->where('role_id', 3)->get();
        $customers = User::where('role_id', 3)->paginate(10);
        $services = Service::all();
        
        return view('livewire.booking_component', [
            'staff' => $staff,
            'services' => $services,
            'customers' => $customers
        ]);
    }
}
