@extends('layouts.sidebar')

@section('pageTitle', 'services')

@section('content')
<a href="users/create" class="btn btn-primary create-btn">Crear nuevo usuario</a>
<table class="stripe infotable" id="usersTable">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Correo</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($users as $user)
    <tr>
      <td>{{$user->name}}</td>
      <td>{{$user->email}}</td>
      <td><a href="users/{{$user->id}}/edit">Asignar Permisos</a> - Cambiar Password</td>
    </tr>
    @endforeach
  </tbody>
</table>

<script>
  $(document).ready( function () {
    var table=$('#usersTable').DataTable();
  });
</script>
@endsection
