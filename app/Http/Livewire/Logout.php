<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Logout extends Component
{

    public function logout()
    {
        //@dd('logout the user');
        Auth::logout();

        return redirect()->route('login');
        
    }

    public function render()
    {
        Auth::logout();

        redirect()->route('login');

        return view('livewire.logout');
    }
}
