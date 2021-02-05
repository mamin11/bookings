<?php

namespace App;

use App\Service;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    protected $primaryKey = 'appointment_id';

    public function getDuration() {
        return ($this->end_at - $this->start_at);
    }

    public function getServicePrice() {
        return Service::where('service_id', $this->service_id)->first()->price;
    }

    public function getPrice() {
        return $this->getDuration() * $this->getServicePrice();
    }
}
