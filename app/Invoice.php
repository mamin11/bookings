<?php

namespace App;

use App\User;
use App\Order;
use App\Appointment;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $guarded = [];
    public $timestamps = true;

    public function getCustomer() {
        return User::where('user_id', $this->customer_id)->first();
    }

    public function getOrder() {
        return Order::where('order_id', $this->order_id)->first();
    }

    public function getBooking() {
        return Appointment::where('appointment_id', $this->appointment_id)->first();
    }
}
