@extends('layouts.sidebar')

@section('pageTitle', 'Clientes')

@section('content')
<a href="/clients/create">Agregar nuevo</a>
 <table id="clientsTable" class="infotable">
     <thead>
       <tr>
         <th>Nombre</th>
         <th>Correo Electronico</th>
         <th>Acciones</th>
       </tr>
     </thead>
     <tbody>
     @foreach ($clients as $client)
      <tr>
        <td>{{$client->name}} {{$client->lastname}}</td>
        <td>{{$client->email}}</td>
      <td><a href="/clients/{{$client->id}}/edit">Editar</a> - Eliminar</td>
      </tr>
     @endforeach
     </tbody>
 </table>
<script>
$(document).ready( function () {
    $('#clientsTable').DataTable();
} );
</script>

<h3 class="panel-title">Nuevo cliente</h3>
<form method="POST" action="{{ route('clients.store') }}"  role="form">
    {{ csrf_field() }}
                <input type="text" name="name" id="name" class="form-control input-sm" placeholder="Nombre">
                <input type="text" name="lastname" id="lastname" class="form-control input-sm" placeholder="Apellido">
                <input type="text" name="email" id="email" class="form-control input-sm" placeholder="Correo Electronico">
                <input type="text" name="rfc" id="rfc" class="form-control input-sm" placeholder="RFC">
                <input type="text" name="fiscalname" id="fiscalname" class="form-control input-sm" placeholder="Nombre Fiscal">
                <input type="text" name="commercialname" id="commercialname" class="form-control input-sm" placeholder="Nombre Comercial">
                <input type="text" name="phone" id="phone" class="form-control input-sm" placeholder="Telefono">
            <input type="submit"  value="Guardar" class="btn btn-success btn-block">
            <a href="{{ route('clients.index') }}" class="btn btn-info btn-block" >Atrás</a>
</form>

@endsection



