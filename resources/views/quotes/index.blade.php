@extends('layouts.sidebar')

@section('pageTitle', 'quotees')

@section('content')
<a href="/quotes/create" class="btn btn-primary">Crear Nueva Cotizacion</a>
<table id="quotesTable" class="infotable">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Fecha Prevista</th>
            <th>Cliente</th>
            <th>Paquete</th>
            <th>Locacion</th>
            <th>Precio</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($quotes as $quote)
         <tr>
           <td><a href="/quotes/{{$quote->id}}">{{$quote->eventName}}</a></td>
           <td>{{$quote->eventDate}}</td>
           <td>{{$quote->client->name}} {{$quote->client->lastname}}</td>
           <td>{{$quote->package->name}}</td>
           <td>{{$quote->venue->name}}</td>
           <td>{{$quote->price}}</td>
         <td><a href="/quotes/{{$quote->id}}/edit">Editar</a> - Eliminar</td>
         </tr>
        @endforeach
        </tbody>
    </table>
    <script>
    $(document).ready( function () {
      $('#quotesTable').DataTable();
    });
    </script>
@endsection
