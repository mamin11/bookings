<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Acaronlex\LaravelCalendar\Calendar;

class CalendarController extends Controller
{

    public function index() {
        $events = [];

        $events[] = \Calendar::event(
            'Event One', //event title
            false, //full day event?
            '2021-03-11T0800', //start time (you can also use Carbon instead of DateTime)
            '2021-03-12T0800', //end time (you can also use Carbon instead of DateTime)
            0 //optionally, you can specify an event ID
        );
        
        $events[] = \Calendar::event(
            "Valentine's Day", //event title
            true, //full day event?
            new \DateTime('2021-03-14'), //start time (you can also use Carbon instead of DateTime)
            new \DateTime('2021-03-14'), //end time (you can also use Carbon instead of DateTime)
            'stringEventId' //optionally, you can specify an event ID
        );

        $calendar = new Calendar();
        $calendar->addEvents($events)
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
