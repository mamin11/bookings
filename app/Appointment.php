<?php

namespace App;

use DateTime;
use App\Service;
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
}
