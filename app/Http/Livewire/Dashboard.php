<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.dashboard');
        // ->layout('layouts.dashboard')
        // ->section('content');
    }
}
