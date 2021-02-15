<?php

namespace App\Http\Livewire;

use App\User;
use App\Service;
use Livewire\Component;
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
        'notifyCustomer' => ''
    ];

    public $formComponents = [
        'showBookingDetailForm' => true,
        'showCustomerDetailForm' => false,
        'showConfirmationForm' => false,
        'showNewCustomerForm' => false,
        'showExistingCustomerForm' => false,
    ];

    public $showBookingComponent = true;

    public $confirmationData = [
        'customer' => '',
        'service' => '',
        'staff' => '',
        'price' => '',
        'date' => '',
        'time' => '',
    ];

    public $showConfirmationDetails = false;

    //event listener
    protected $listeners = ['bookingClose'];

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

    public function getEndDate($start_date) {
        return $start_date;
        // return gmdate('TH:i:s ', $start_date);
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
        if($this->formComponents['showConfirmationForm'] == true) {
            // if($this->bookingForm['service_id']) {
                $this->confirmationData['staff'] = $this->bookingForm['staff_id'] ? User::find( $this->bookingForm['staff_id']) : '';
                $this->confirmationData['customer'] = $this->bookingForm['customer_id'] ? User::find( $this->bookingForm['customer_id']) : '';
                $this->confirmationData['service'] = $this->bookingForm['service_id'] ? Service::find( $this->bookingForm['service_id']) : '';
                $this->confirmationData['price'] = $this->bookingForm['duration'] ? $this->getPrice($this->confirmationData['service']['price'],$this->bookingForm['duration']) : '';
                $this->confirmationData['date'] = $this->bookingForm['start_date'];
                $this->confirmationData['time'] = $this->bookingForm['start_time'];
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
        // @dd($this->bookingForm['start_at']);
        @dd($this->confirmationData);
        // @dd($this->confirmationData['service']['price']);
        // @dd($this->getPrice($this->confirmationData['service']['price'],$this->bookingForm['duration']));
        // @dd($this->getEndDate($this->bookingForm['start_time']));
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
