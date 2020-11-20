<?php

namespace App\Http\Livewire;

use Livewire\Component;

class BookingComponent extends Component
{
    public $formComponents = [
        'showBookingDetailForm' => true,
        'showCustomerDetailForm' => false,
        'showConfirmationForm' => false,
    ];

    public $showBookingComponent = true;

    public $data = [];


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

    }

    public function closeComponent()
    {
        $this->showBookingComponent = false;
    }
    
    public function render()
    {
        return view('livewire.booking_component');
    }
}
