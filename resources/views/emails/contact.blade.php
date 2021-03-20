@component('mail::message')
# Contact Email - sedowstudios

Sender name - {{$data['name']}}<br>

Sender email - {{$data['email']}}

Message:<br>
{{$data['message']}}.


Thanks,<br>
{{ config('app.name') }}
@endcomponent
