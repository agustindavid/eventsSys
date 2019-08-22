@extends('layouts.sidebar')

@section('pageTitle', 'Clientes')

@section('content')
<a href="/clients/create">Agregar nuevo</a>
<div class="defaultForm">
        <h3 class="panel-title">Nuevo Cliente</h3>
        <form role="form" class="newClientForm">
        {{ csrf_field() }}
          <div class="form-row form-group">
            <div class="col">
              <label for="name">Nombre</label>
              <input type="text" name="name" id="name" class="form-control input-sm" placeholder="Nombre">
            </div>
            <div class="col">
              <label for="lastname">Apellido</label>
              <input type="text" name="lastname" id="lastname" class="form-control input-sm" placeholder="Apellido">
            </div>
          </div>
          <div class="form-row form-group">
            <div class="col">
              <label for="email">Email</label>
              <input type="text" name="email" id="email" class="form-control input-sm" placeholder="Correo Electronico">
            </div>
            <div class="col">
              <label for="rfc">RFC</label>
              <input type="text" name="rfc" id="rfc" class="form-control input-sm" placeholder="RFC">
            </div>
          </div>
          <div class="form-row form-group">
            <div class="col">
              <label for="fiscalname">Nombre Fiscal</label>
              <input type="text" name="fiscalname" id="fiscalname" class="form-control input-sm" placeholder="Nombre Fiscal">
            </div>
            <div class="col">
              <label for="commercialname">Nombre Comercial</label>
              <input type="text" name="commercialname" id="commercialname" class="form-control input-sm" placeholder="Nombre Comercial">
            </div>
          </div>
          <div class="form-row form-group">
            <div class="col-md-6">
              <label for="phone">Telefono</label>
              <input type="text" name="phone" id="phone" class="form-control input-sm" placeholder="Telefono">
            </div>
          </div>
          <div class="form-group">
              <input type="submit"  value="Guardar" class="btn btn-success btn-block createClient">
              <a href="#" class="btn btn-info btn-block clientFormClose" >Cerrar</a>
          </div>
        </form>
      </div>

      <div class="alert alert-success success-message" role="alert"></div>

      <table id="clientsTable" class="infotable stripe">
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
    var table=$('#clientsTable').DataTable();


$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$('.newClientForm').submit(function(event) {
event.preventDefault();
var formData = {
    'name': $('input[name=name]').val(),
    'lastname': $('input[name=lastname]').val(),
    'email': $('input[name=email]').val(),
    'rfc': $('input[name=rfc]').val(),
    'fiscalname': $('input[name=fiscalname]').val(),
    'commercialname': $('input[name=commercialname]').val(),
    'phone': $('input[name=phone]').val()
};
// process the form
$.ajax({
    type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
    url         : '/api/clients', // the url where we want to POST
    data        : formData // our data object
}).done(function(data) {
        $('.newClientForm').trigger("reset");
        $('.success-message').slideToggle();
        $('.success-message').html(data.msg);
        console.log(data);

        // here we will handle errors and validation messages
    });
});

} );

</script>

@endsection



