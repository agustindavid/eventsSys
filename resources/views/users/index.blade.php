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
<div class="table-responsive">
  <table class="stripe infotable" id="usersTable">
    <thead>
        <tr>
        <th style="width:20%">Nombre</th>
        <th style="width:20%">Correo</th>
        <th style="width:40%">Tiene acceso a</th>
        <th style="width:20%">Acciones</th>
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
</div>
<script>
  $(document).ready( function () {
    var table=$('#usersTable').DataTable({
        responsive: true
    });
  });
</script>
@endsection
