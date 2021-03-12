<?php

namespace App;

use App\User;
use App\Conversation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Message extends Model
{
    protected $guarded = [];

    // public function getSender() {
    //     $convo = Conversation::where('id', $this->convo_id)->first();
    //     return User::where('user_id', $convo->sender)->first();
    // }

    // public function getReceiver() {
    //     $convo = Conversation::where('id', $this->convo_id)->first();
    //     return User::where('user_id', $convo->receiver)->first();
    // }

    public function getSender() {
        return User::where('user_id', $this->sender)->first();
    }

    public function getSenderPic() {
        $user = User::where('user_id', $this->sender)->first();
        if(!$user) {
            return Storage::disk('s3')->url('staff/'.$user->image);
        }
        return 'img/user-profile.png';
    }

    public function getReceiverPic() {
        $user = User::where('user_id', $this->receiver)->first();
        if(!$user) {
            return Storage::disk('s3')->url('staff/'.$user->image);
        }
        return 'img/user-profile.png';
    }
    
    public function getReceiver() {
        return User::where('user_id', $this->receiver)->first();
    }

    public function getLatestMessage() {
        return Message::where(['receiver' => $this->receiver, 'sender' => Auth::user()->user_id])->latest()->first();
    }
}
