<?php

namespace App\Http\Livewire\Admin;

use App\Message;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Sidenav extends Component
{
    public $messagesCount;

    public function mount() {
        $this->messagesCount = Message::where(['receiver' => Auth::user()->user_id, 'status' => 1])->count();
    }

    public function render()
    {
        return view('livewire.admin.sidenav');
    }
}
