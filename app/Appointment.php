<?php

namespace App;

use App\User;
use DateTime;
use App\Service;
use App\User_appointment;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    protected $primaryKey = 'appointment_id';

    public function getDuration() {
        $diff = strtotime($this->end_at) - strtotime($this->start_at);
        $diffH = gmdate('H:i:s ',$diff);
        $h = explode(':', $diffH)[0];
        return $h;
    }

    public function getServicePrice() {
        return Service::where('service_id', $this->service_id)->first()->price;
    }

    public function getPrice() {
        return $this->getDuration() * $this->getServicePrice();
    }

    public function getService() {
        return Service::where('service_id', $this->service_id)->first();
    }

    public function getStaff() {
        return User::where('user_id', $this->user_id)->first();
    }
    
    public function getCustomer() {
        $customer_id = User_appointment::where('appointment_id', $this->appointment_id)->first()->customer_id;
        return User::where('user_id', $customer_id)->first();
    }

}
