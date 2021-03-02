<?php

namespace App\Http\Controllers;

use App\Appointment;
use Illuminate\Http\Request;
use Acaronlex\LaravelCalendar\Calendar;

class CalendarController extends Controller
{

    public function index() {
        $date = date("Y-m-d H:i:s");
        $bookings = Appointment::where('cancelled', 1)->get();


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
