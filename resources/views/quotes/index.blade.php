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
    <li class="active"><a class="active" data-toggle="tab" href="#menu1">Por aprobar</a></li>
    <li class=""><a class="" data-toggle="tab" href="#home">Aprobadas</a></li>
  </ul>
</div>
<div class="tab-content">
 <div id="menu1" class="tab-pane fade in active show">
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
          <th>Vendedor</th>
          <th>Paquete</th>
          <th>Locación</th>
          <th>Precio</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
      @foreach ($quotes as $quote)
        <tr class="data-row">
          <td data-title="">{{$quote->eventName}}</td>
          <td data-title="Fecha">{!! \Carbon\Carbon::parse($quote->eventDate)->format('d/m/Y') !!}</td>
          <td data-title="Cliente">{{$quote->client->name}} {{$quote->client->lastname}}</td>
          <td data-title="Vendedor">{{$quote->user->name}}</td>
          <td data-title="Paquete">{{$quote->package->name}}</td>
          <td data-title="Locación">{{$quote->venue->name}}</td>
          <td data-title="Precio">{{$quote->price}}</td>
          <td data-title="Acciones"><a class="btn btn-primary" href="{{url('/')}}/quotes/{{$quote->id}}">+ info</a></td>
        </tr>
    @endforeach
    </tbody>
  </table>
 </div>
</div>
<div id="home" class="tab-pane fade">
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
            <th>Vendedor</th>
            <th>Paquete</th>
            <th>Locación</th>
            <th>Precio</th>
            <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($approvedQuotes as $quote)
            <tr class="data-row">
              <td data-title="">{{$quote->eventName}}</td>
              <td data-title="Fecha">{!! \Carbon\Carbon::parse($quote->eventDate)->format('d/m/Y') !!}</td>
              <td data-title="Cliente">{{$quote->client->name}} {{$quote->client->lastname}}</td>
              <td data-title="Vendedor">{{$quote->user->name}}</td>
              <td data-title="Paquete">{{$quote->package->name}}</td>
              <td data-title="Locación">{{$quote->venue->name}}</td>
              <td data-title="Precio">${{$quote->price}}</td>
              <td data-title="Acciones"><a class="btn btn-primary btn-sm" href="{{url('/')}}/events/{{$quote->event->id}}">+ info</a></td>
            </tr>
            @endforeach
          </tbody>
        </table>
    </div>
  </div>
</div>






    <script>
    $(document).ready( function () {
      $('#quotesTable').DataTable({
          responsive: true
      });
      $('#approvedQuotesTable').DataTable();

      $('.data-row').click(function(){
          if($(this).hasClass('visible-info')){
            $(this).removeClass('visible-info');
          }else{
            $('.data-row').removeClass('visible-info');
            $(this).addClass('visible-info');
          }
      })
    });
    </script>
@endsection
