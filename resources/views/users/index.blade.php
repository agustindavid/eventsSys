@extends('layouts.sidebar')

@section('pageTitle', 'services')

@section('content')
<div class="row">
    <div class="col">
        <div class="btn-wrap">
          <a href="users/create" class="btn btn-primary create-btn">Crear nuevo usuario</a>
        </div>
    </div>
</div>

<table class="stripe infotable" id="usersTable">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Correo</th>
      <th>Tiene acceso a</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($users as $user)
    <tr>
      <td>{{$user->name}}</td>
      <td>{{$user->email}}</td>
      <td>
          @foreach($user->getAllPermissions() as $permission)
            {{$permission->name}}
          @endforeach
      </td>
      <td><a class="btn btn-outline-info" href="users/{{$user->id}}/edit">Editar y Asignar Permisos</a></td>
    </tr>
    @endforeach
  </tbody>
</table>

<script>
  $(document).ready( function () {
    var table=$('#usersTable').DataTable({
        responsive: true
    });
  });
</script>
@endsection
