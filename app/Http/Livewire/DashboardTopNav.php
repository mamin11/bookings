<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DashboardTopNav extends Component
{
    // public $showBookingComponent = false;

    // public function openComponent()
    // {
    //     //@dd('heeeeererererre');
    //     $this->showBookingComponent = true;
    // }

    public function render()
    {
        return view('livewire.dashboard_top_nav');
    }
}
