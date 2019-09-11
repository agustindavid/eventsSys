@extends('layouts.sidebar')

@section('pageTitle', 'Cotizaciones')

@section('content')
<div class="row">
    <div class="col">
        <div class="btn-wrap">
          <a href="{{url('/')}}/quotes/create" class="btn btn-primary">Crear Nueva Cotización</a>
        </div>
    </div>
</div>
<div class="row tableWrapper">
    <div class="col">
        <h3>Cotizaciones Aprobadas</h3>
        <hr>
    </div>
<table id="quotesTable" class="infotable stripe">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Fecha Prevista</th>
            <th>Cliente</th>
            <th>Paquete</th>
            <th>Locación</th>
            <th>Precio</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($approvedQuotes as $quote)
         <tr>
           <td><a href="{{url('/')}}/quotes/{{$quote->id}}">{{$quote->eventName}}</a></td>
           <td>{{$quote->eventDate}}</td>
           <td>{{$quote->client->name}} {{$quote->client->lastname}}</td>
           <td>{{$quote->package->name}}</td>
           <td>{{$quote->venue->name}}</td>
           <td>{{$quote->price}}</td>
           <td><a href="{{url('/')}}/events/{{$quote->event->id}}">Ver Detalles del evento</a></td>
         </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="row tableWrapper">
        <div class="col">
                <h3>Cotizaciones por aprobar</h3>
                <hr>
            </div>
    <table id="approvedQuotesTable" class="infotable stripe">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Fecha Prevista</th>
                <th>Cliente</th>
                <th>Paquete</th>
                <th>Locación</th>
                <th>Precio</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($quotes as $quote)
             <tr>
               <td><a href="{{url('/')}}/quotes/{{$quote->id}}">{{$quote->eventName}}</a></td>
               <td>{{$quote->eventDate}}</td>
               <td>{{$quote->client->name}} {{$quote->client->lastname}}</td>
               <td>{{$quote->package->name}}</td>
               <td>{{$quote->venue->name}}</td>
               <td>{{$quote->price}}</td>
             <td><a href="{{url('/')}}/quotes/{{$quote->id}}">Ver Detalles de la Cotizacion</a></td>
             </tr>
            @endforeach
            </tbody>
        </table>
</div>
    <script>
    $(document).ready( function () {
      $('#quotesTable').DataTable();
      $('#approvedQuotesTable').DataTable();
    });
    </script>
@endsection
