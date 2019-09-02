@extends('layouts.sidebar')

@section('pageTitle', 'services')

@section('content')

<nav>
    <ul>
        @foreach ($venues as $venue)
          <li>{{$venue->name}}</li>
        @endforeach
    </ul>
</nav>
<script>

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: [ 'interaction', 'dayGrid', 'timeGrid' ],
      defaultView: 'dayGridMonth',
      defaultDate: '2019-08-07',
      color: 'yellow',   // a non-ajax option
      textColor: 'black', // a non-ajax option
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      events: 'http://localhost:8000/api/quotes'
    });
    console.log(this.events);
    calendar.render();
  });

</script>

</head>
<body>

  <div id='calendar'></div>

@endsection
