<?php

namespace App;

use App\Role;
use App\Address;
use App\Message;
use App\User_appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'address_id', 'date_of_birth', 'role_id', 'image', 'google_id', 'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $guarded = [];
    public $timestamps = true;
    protected $primaryKey = 'user_id';

    public function getAddress(){
        return Address::where('address_id', $this->addrress_id)->first();
    }

    public function getRole() {
        return Role::where('role_id', $this->role_id)->first();
    }

    public function getStaffProfilePic() {
        if($this->image) {
            return Storage::disk('s3')->url('staff/'.$this->image);
        }
        return 'img/user-profile.png';
    }

    public function getCustomerProfilePic() {
        if($this->image) {
            return Storage::disk('s3')->url('customer/'.$this->image);
        }
        return 'img/user-profile.png';
    }

    public function getCustomerBookings() {
        return User_appointment::where('customer_id', $this->user_id);
    }

    public function getUserBookings() {
        return User_appointment::where('customer_id', $this->user_id)->get();
    }

    public function getMessages() {
        return Message::where('sender', $this->user_id)->orWhere('receiver', $this->user_id)->get();
    }

    public function getLatestMessage() {
        return Message::where('sender', $this->user_id)->orWhere('receiver', $this->user_id)->latest()->first();
    }

    public static function search($search) {
        return empty($search) ? static::query()
        : static::where('name', 'like', '%'.$search.'%')
        ->orWhere('email', 'like', '%'.$search.'%')
        ->orWhere('user_id', 'like', '%'.$search.'%');
    }
}
