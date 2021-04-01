<?php

namespace App\Http\Livewire\Settings;

use App\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class View extends Component
{
    public $number = '';
    public $check = false;

    public function mount() {
        $this->number = Auth::user()->phone_number ? Auth::user()->phone_number : '';
    }

    public function addNumber() {
        $user = User::where('user_id', Auth::user()->user_id)->first();
        $user->phone_number = $this->number;
        $user->save();
        return redirect()->route('settings');
    }
    public function render()
    {
        return view('livewire.settings.view');
    }
}
