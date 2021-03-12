<?php

namespace App\Http\Livewire\Chat;

use App\User;
use App\Message;
use App\Conversation;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class View extends Component
{
    public $users;
    public $formInput;
    public $activeConvoID;
    public $activeUser;

    public function mount() {
        $this->users = User::all();
    }

    public function sendMessage() {
        $message = Message::create([
            'message' => $this->formInput,
            'sender' => Auth::user()->user_id,
            'receiver' => $this->activeConvoID,
        ]);

        $this->formInput = '';
    }

    public function setAciveChat($userID) {
        $this->activeConvoID = $userID;
        $this->activeUser = User::where('user_id', $userID)->first();
    }

    public function render()
    {
        return view('livewire.chat.view');
    }
}
