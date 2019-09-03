@extends('layouts.sidebar')

@section('pageTitle', 'Clientes')

@section('content')
<div class="row">
    <div class="col">
        <div class="btn-wrap">
            <a class="btn btn-primary create-btn newClient" href="/clients/create">Dar de alta nuevo cliente</a>
        </div>
    </div>
</div>
<div class="defaultForm hiddenFormWrapper" id="newClientFormWrap">
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
              <label for="dniType">Tipo de documento</label>
              <select name="dniType" id="dniType" class="form-control input-sm">
                  <option value="IFE">IFE</option>
                  <option value="FMM">FMM</option>
                  <option value="Pasaporte">Pasaporte</option>
              </select>
            </div>
            <div class="col">
              <label for="dni">Numero de documento</label>
              <input type="text" name="dni" id="dni" class="form-control input-sm" placeholder="Numero de documento">
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
            <div class="col">
              <label for="phone">Telefono</label>
              <input type="text" name="phone" id="phone" class="form-control input-sm" placeholder="Telefono">
            </div>
            <div class="col">
                <label for="rfc">RFC</label>
                <input type="text" name="rfc" id="rfc" class="form-control input-sm" placeholder="RFC">
              </div>
          </div>
          <div class="form-row text-center">
              <h4 class="text-center">Datos de direccion</h4>
          </div>
          <div class="form-row form-group">
              <div class="col">
                <label>Ingrese ciudad o estado</label>
                <input type="text" class="my-input form-control input-sm" placeholder="Buscar por ciudad o estado" autocomplete="off">
              </div>
          </div>
          <div class="form-row form-group">
                <div class="col">
                  <label for="city">Ciudad</label>
                  <input type="text" name="city" id="city" readonly class="form-control input-sm" placeholder="Ciudad">
                </div>
                <div class="col">
                  <label for="state">Estado</label>
                  <input type="text" name="state" id="state" readonly class="form-control input-sm" placeholder="Estado">
               </div>
              </div>
          <div class="form-row form-group">
            <div class="col">
              <label for="number">Numero de casa</label>
              <input type="text" name="number" id="number" class="form-control input-sm" placeholder="Numero de casa/Departamento">
            </div>
            <div class="col">
                <label for="street">Calle</label>
                <input type="text" name="street" id="street" class="form-control input-sm" placeholder="Calle">
            </div>
          </div>
          <div class="form-row form-group">
            <div class="col">
              <label for="colony">Colonia</label>
              <input type="text" name="colony" id="colony" class="form-control input-sm" placeholder="Colonia">
            </div>
            <div class="col">
                <label for="postalCode">Codigo postal</label>
                <input type="number" name="postalCode" id="postalCode" class="form-control input-sm" placeholder="Codigo Postal">
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
$('.newClient').click(function(e){
    e.preventDefault();
    $('#newClientFormWrap').slideToggle();
})


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
    'phone': $('input[name=phone]').val(),
    'dni': $('input[name=dni]').val(),
    'dniType': $('input[name=dniType]').val(),
    'number': $('input[name=number]').val(),
    'street': $('input[name=street]').val(),
    'colony': $('input[name=colony]').val(),
    'postalCode': $('input[name=postalCode]').val(),
    'state': $('input[name=state]').val(),
    'city': $('input[name=city]').val()
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
<script src="https://developers.teleport.org/assets/autocomplete/teleport-autocomplete.6024c12b.js"></script>
<script>
    var $results = document.querySelector('.results');
    var appendToResult = $results.insertAdjacentHTML.bind($results, 'afterend');

    TeleportAutocomplete.init('.my-input').on('change', function(value) {
      var data=value;
      console.log(data);
      $('#city').val(data.name);
      $('#state').val(data.admin1Division);
    });
  </script>
@endsection



