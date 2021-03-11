@component('mail::message')
# Payment Reminder 

This is to remind you have an invoice due to be paid:

<div  class="container">
Please pay before its due date or you risk your booking reservation being cancelled. Find the appointment details below:
</div>

<div class="col-10">
    <div class="list-group-item" style="font-size: large">
        <span class=""> <b>Date:</b> {{date('Y:m:d ',strtotime($booking->start_at))}} </span><br>
        <span class=""> <b>Time:</b> {{date('H:i ',strtotime($booking->start_at))}}-{{date('H:i ',strtotime($booking->end_at))}} </span><br>
        <span class=""> <b>Service:</b> {{$booking->getService()->name}}</span><br>
        <span class=""> <b>Staff:</b> {{$booking->getStaff()->name}}</span><br>
        <span class=""> <b>Total Price:</b> £{{$booking->getPrice()}} (£{{$booking->getServicePrice()}}/hr)</span><br>
    </div>
</div>


<hr>


We hope to see you soon.


Thanks,<br>
{{ config('app.name') }}
@endcomponent
