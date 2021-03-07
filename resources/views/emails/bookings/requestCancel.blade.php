@component('mail::message')
# Booking Cancellation Request

The following booking has been requested to be cancelled by the customer:

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
</div>

@component('mail::button', ['url' => ''])
Cancel Now
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
