<?php

namespace App\Http\Controllers;

use App\Appointment;
use Illuminate\Http\Request;

class IcalendarController extends Controller
{
    public function getIcalEvents() {
        $events = Appointment::where('cancelled', 1)->get();

        define('ICAL_FORMAT', 'Ymd\This\Z');

        $icalObject = "BEGIN:VCALENDAR
        VERSION:2.0
        METHOD:PUBLISH
        PROID:-//sedowStudios//Bookings Calendar//EN\n";

        foreach ($events as $event) {
            $icalObject .=
            "BEGIN:VEVENT
            DTSTART:" .date(ICAL_FORMAT, strtotime($event->start_at)) . "
            DTEND:" .date(ICAL_FORMAT, strtotime($event->end_at)) ."
            DTSTAMP:" .date(ICAL_FORMAT, strtotime($event->created_at)) . "
            UID:$event->id
            LAST-MODIFIED:" .date(ICAL_FORMAT, strtotime($event->updated_at)) ."
            END:VEVENT\n";
        }

        //close the calendar
        $icalObject .= "END:VCALENDAR";

        // Set the headers
        header('Content-type: text/calendar; charset=utf-8');
        header('Content-Disposition: attachment; filename="cal.ics"');
        
        $icalObject = str_replace(' ', '', $icalObject);
    
        echo $icalObject;

        // return $events;
    }
}
