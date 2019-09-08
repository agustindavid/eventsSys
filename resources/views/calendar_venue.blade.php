@extends('layouts.sidebar')

@section('pageTitle', 'services')

@section('content')

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Locaciones:</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            @foreach ($venues as $u_venue)
              <li class="nav-item"><a href="/calendar/{{$u_venue->id}}" class="nav-link" data-venue={{$u_venue->id}}>{{$u_venue->name}}</a></li>
            @endforeach
        </ul>
    </div>
</nav>


  <div id='calendar'></div>

  <script>

    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');

      var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: [ 'interaction', 'dayGrid', 'timeGrid' ],
        defaultView: 'dayGridMonth',
        defaultDate: '2019-08-07',
        color: 'yellow',   // a non-ajax option
        textColor: 'black', // a non-ajax option
        locale: 'es',
        header: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: '{{url('/')}}/api/checkquotes/{{$venue->id}}'
      });
      calendar.render();


});




  </script>

@endsection
