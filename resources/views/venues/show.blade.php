@extends('layouts.sidebar')

@section('pageTitle', 'services')

@section('content')

<div class="dataInfo">
  <div class="row text-center">
    <div class="col-md-12">
        <h3>Nombre: {{$venue->name}}</h3>
    </div>
    <div class="col">
        <p>Direccion: {{$venue->location}}</p>
    </div>
    <div class="col">
        <p>Minimo de personas recomendado: {{$venue->mincapacity}} personas</p>
    </div>
    <div class="col">
        <p>Capacidad: {{$venue->maxcapacity}} personas</p>
    </div>
  </div>
  <div class="row">
    <div id='calendar'></div>
  </div>
</div>



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
      events: 'http://localhost:8000/api/checkquotes/{{$venue->id}}'
    });
    console.log(this.events);
    calendar.render();
  });

</script>

@endsection
