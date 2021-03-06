<?php

namespace App;

use App\Appointment;
use Illuminate\Database\Eloquent\Model;

class User_appointment extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    protected $primaryKey = 'user_appointment_id';

    public function appointments() {
        return $this->hasMany(Appointment::class);
    }

    public function getBookings() {
        return Appointment::where('appointment_id', $this->appointment_id)->get();
    }

    public function getBookingData() {
        return Appointment::where('appointment_id', $this->appointment_id)->first();
    }
    
    // public function getCancelledAppointments() {
    //     return User_appointment::where('cancelled', '=' , 0)->get();
    // }
}
