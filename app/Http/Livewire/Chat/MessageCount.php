<?php

namespace App\Http\Livewire\Chat;

use App\Message;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class MessageCount extends Component
{
    public $messagesCount = 0;

    public function mount() {
        $this->messagesCount = Message::where(['receiver' => Auth::user()->user_id, 'status' => 1])->count();
    }
    public function render()
    {
        return view('livewire.chat.message-count');
    }
}
