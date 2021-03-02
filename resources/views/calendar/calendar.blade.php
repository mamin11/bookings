@extends('layouts.dashboard')
@section('content')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.css"/>

    <div class="container">
        {!! $calendar->calendar() !!}
        {!! $calendar->script() !!}
    </div>
    
    @endsection
