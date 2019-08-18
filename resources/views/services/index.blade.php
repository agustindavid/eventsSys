@extends('layouts.sidebar')

@section('pageTitle', 'services')

@section('content')

<table id="servicesTable" class="infotable">
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Categoria</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($services as $service)
     <tr>
       <td><a href="/services/{{$service->id}}">{{$service->name}}</a></td>
       <td>{{$service->servicePrice}}</td>
       <td>{{$service->categories->name}}</td>
     <td><a href="/services/{{$service->id}}/edit">Editar</a> - Eliminar</td>
     </tr>
    @endforeach
    </tbody>
</table>
<script>
$(document).ready( function () {
  $('#servicesTable').DataTable();
});
</script>
@endsection
