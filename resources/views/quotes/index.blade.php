@extends('layouts.sidebar')

@section('pageTitle', 'Cotizaciones')

@section('content')
<div class="row no-margin">
    <div class="col">
        <div class="btn-wrap">
          <a href="{{url('/')}}/quotes/create" class="btn btn-primary">Crear Nueva Cotización</a>
        </div>
    </div>
</div>
<div class="row no-margin">
  <ul class="nav nav-pills quoteSelector">
    <li class="active"><a class="active" data-toggle="tab" href="#home">Cotizaciones Aprobadas</a></li>
    <li><a data-toggle="tab" href="#menu1">Cotizaciones sin aprobar</a></li>
  </ul>
</div>
<div class="tab-content">
  <div id="home" class="tab-pane fade in active show">
    <div class="row no-margin tableWrapper table-responsive">
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
              <td data-title="Nombre"><a href="{{url('/')}}/quotes/{{$quote->id}}">{{$quote->eventName}}</a></td>
              <td data-title="Fecha">{{$quote->eventDate}}</td>
              <td data-title="Cliente">{{$quote->client->name}} {{$quote->client->lastname}}</td>
              <td data-title="Paquete">{{$quote->package->name}}</td>
              <td data-title="Locación">{{$quote->venue->name}}</td>
              <td data-title="Precio">{{$quote->price}}</td>
              <td data-title="Acciones"><a href="{{url('/')}}/events/{{$quote->event->id}}">Ver Detalles del evento</a></td>
            </tr>
            @endforeach
          </tbody>
        </table>
    </div>
  </div>
  <div id="menu1" class="tab-pane fade">
  <div class="row no-margin tableWrapper table-responsive">
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
          <td data-title="Nombre"><a href="{{url('/')}}/quotes/{{$quote->id}}">{{$quote->eventName}}</a></td>
          <td data-title="Fecha">{{$quote->eventDate}}</>
          <td data-title="Cliente">{{$quote->client->name}} {{$quote->client->lastname}}</td>
          <td data-title="Paquete">{{$quote->package->name}}</td>
          <td data-title="Locación">{{$quote->venue->name}}</td>
          <td data-title="Precio">{{$quote->price}}</td>
          <td data-title="Acciones"><a href="{{url('/')}}/quotes/{{$quote->id}}">Ver Detalles de la Cotizacion</a></td>
        </tr>
    @endforeach
    </tbody>
  </table>
 </div>
</div>
  <div id="menu2" class="tab-pane fade">
    <h3>Menu 2</h3>
    <p>Some content in menu 2.</p>
  </div>
</div>






    <script>
    $(document).ready( function () {
      $('#quotesTable').DataTable({
          responsive: true
      });
      $('#approvedQuotesTable').DataTable();
    });
    </script>
@endsection
