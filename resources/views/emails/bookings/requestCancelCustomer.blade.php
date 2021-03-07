@component('mail::message')
# Booking Cancellation Confirmation

Dear Customer, we have received a request to cancel the following booking. We will process your request and get back to you:

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
#Reason for cancellation:
<div class="col-10">
    {{$message}}
</div><br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
