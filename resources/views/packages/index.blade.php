@extends('layouts.sidebar')

@section('pageTitle', 'packagees')

@section('content')
<table id="packagesTable" class="infotable">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($packages as $package)
         <tr>
           <td><a href="/packages/{{$package->id}}">{{$package->name}}</a></td>
           <td>{{$package->price}}</td>
         <td><a href="/packages/{{$package->id}}/edit">Editar</a> - Eliminar</td>
         </tr>
        @endforeach
        </tbody>
    </table>
    <script>
    $(document).ready( function () {
      $('#packagesTable').DataTable();
    });
    </script>
@endsection
