<?php

namespace App\Http\Controllers;

use App\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Acaronlex\LaravelCalendar\Calendar;

class CalendarController extends Controller
{

    public function index() {
        $date = date("Y-m-d H:i:s");

        if(Auth::user()->role_id == 1) {
            //show admin all bookings
            $bookings = Appointment::where('cancelled', 1)->get();
        } else if(Auth::user()->role_id == 2) {
            //show staff their bookings
            $bookings = Appointment::where('cancelled', 1)->where('user_id', Auth::user()->user_id)->get();
        }  else {
            //show no bookings
            $bookings = [];
        }


        $calendar = new Calendar();
        $calendar->addEvents($bookings)
        ->setOptions([
            'firstDay' => 0,
            'displayEventTime' => true,
            'selectable' => false,
            'initialView' => 'dayGridMonth',
            'headerToolbar' => [
                'end' => 'today prev,next dayGridMonth timeGridWeek timeGridDay'
            ]
        ]);
        $calendar->setId('1');
        $calendar->setCallbacks([
            'select' => 'function(selectionInfo){}',
            'eventClick' => 'function(event){}'
        ]);
        return view('calendar.calendar', compact('calendar'));
    }
}
