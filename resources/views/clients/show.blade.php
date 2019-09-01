@extends('layouts.sidebar')

@section('pageTitle', 'Clientes')

@section('content')
<div class="dataInfo">
    <div class="row">
        <h4>Informacion general</h4>
    </div>
  <div class="row">
    <div class="col">
      <p>Nombre: {{$client->name}} {{$client->lastname}}</p>
      <p>Email: {{$client->email}}</p>
    </div>
    <div class="col">
      <p>Tipo de documento: {{$client->dniType}}</p>
      <p>Numero de documento: {{$client->dni}}</p>
    </div>
    <div class="col">
      <p>Nombre fiscal: {{$client->fiscalname}}</p>
      <p>Nombre comercial: {{$client->commercialname}}</p>
    </div>
    <div class="col">
      <p>RFC: {{$client->rfc}}</p>
      <p>Telefono: {{$client->phone}}</p>
    </div>
  </div>
    <div class="row">
      <h4>Datos de direccion</h4>
    </div>
    <div class="row">
      <div class="col">
        <p>Ciudad: {{$client->city}}, {{$client->state}}</p>
      </div>
      <div class="col">
        <p>Calle: {{$client->street}}, {{$client->colony}}, {{$client->number}}</p>
        <p>Codigo postal: {{$client->postalCode}}</p>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col">
        <h3>Eventos Activos({{$events->count()}})</h3>
        <p>Total pagado: {{$events->sum('total_paid')}} </p>
        <p>Total adeudado: {{$events->sum('total_debt')}} </p>
      </div>
    </div>
    <div class="row">
        <table id="eventsTable" class="infotable">
        <thead>
            <tr>
            <th>Nombre</th>
            <th>Paquete</th>
            <th>Cliente</th>
            <th>Locacion</th>
            <th>Monto total</th>
            <th>Monto pagado</th>
            <th>Monto adeudado</th>
            <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($events as $event)
            <tr>
            <td>{{$event->quote->eventName}}</td>
            <td>{{$event->quote->package->name}}</td>
            <td>{{$event->quote->client->name}} {{$event->quote->client->lastname}}</td>
            <td>{{$event->quote->venue->name}}</td>
            <td>{{$event->quote->price}}</td>
            <td>{{$event->total_paid}}</td>
            <td>{{$event->total_debt}}</td>
            <td><a href="/events/{{$event->id}}">ver detalles</a> - Eliminar</td>
            </tr>
        @endforeach
        </tbody>
        </table>
    </div>
</div>
<script>
        $(document).ready( function () {
           $('#eventsTable').DataTable();
        } );
        </script>
@endsection
