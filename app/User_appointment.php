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
}
