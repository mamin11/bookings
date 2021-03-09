@component('mail::message')
# Booking Confirmation 

This is to verify that the following booking has been created for you:

<div  class="container">
Please be aware that the booking has been reserved only for 24 hours.It will automatically be cancelled if no payment is received.
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
