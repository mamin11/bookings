@component('mail::message')
# Payment Received 

This is to verify that we have received your payment:

<div  class="container">
Your receipt has been attached to this email. If there is any issue please contact us.
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
