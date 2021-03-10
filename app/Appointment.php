<?php

namespace App;

use App\User;
use DateTime;
use App\Service;
use Carbon\Carbon;
use App\User_appointment;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model implements \Acaronlex\LaravelCalendar\Event
{
    protected $guarded = [];
    public $timestamps = true;
    protected $primaryKey = 'appointment_id';
    protected $dates = ['start_at', 'end_at'];


    public function getDuration() {
        $diff = strtotime($this->end_at) - strtotime($this->start_at);
        $diffH = gmdate('H:i:s ',$diff);
        $h = explode(':', $diffH)[0];
        return $h;
    }

    public function getServicePrice() {
        return Service::where('service_id', $this->service_id)->first()->price;
    }

    public function getTotalPrice() {
        return User_appointment::where('appointment_id', $this->appointment_id)->first()->total_price;
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

    //full calendar package imaplemented class required methods
    /**
     * Get the event's id number
     *
     * @return int
     */
    public function getId() {
		return $this->appointment_id;
	}

    /**
     * Get the event's title
     *
     * @return string
     */
    public function getTitle()
    {
        $title = $this->getService()->name .' : '.$this->getStaff()->name;
        return $title;
    }

    /**
     * Is it an all day event?
     *
     * @return bool
     */
    public function isAllDay()
    {
        return (bool)$this->all_day;
    }

    /**
     * Get the start time
     *
     * @return DateTime
     */
    public function getStart()
    {
        return Carbon::parse($this->start_at);
    }

    /**
     * Get the end time
     *
     * @return DateTime
     */
    public function getEnd()
    {
        return Carbon::parse($this->end_at);
    }

}
