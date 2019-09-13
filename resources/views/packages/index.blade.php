@extends('layouts.sidebar')

@section('pageTitle', 'Paquetes')

@section('content')
<div class="defaultForm">
<h3 class="panel-title">Nuevo Paquete</h3>
  <form method="POST" class="newPackageForm"  role="form">
  {{ csrf_field() }}
    <div class="form-row form-group">
      <div class="col-xs col-md-6 mb1r">
        <label for="name">Nombre del paquete</label>
        <input type="text" name="name" id="name" class="form-control input-sm" placeholder="Nombre">
      </div>
      <div class="col-xs-6 col-md-6">
        <label for="minQty">Cantidad minima de personas</label>
        <input type="number" name="minQty" id="minQty" class="form-control input-sm" placeholder="Cantidad minima de personas">
      </div>
    </div>
    <div class="form-group form-row">
      <div class="col">
        <label for="kidsPrice">Precio por niño</label>
        <input type="number" name="kidsPrice" id="kidsPrice" class="form-control input-sm" placeholder="Precio por niño">
      </div>
      <div class="col">
        <label for="adultPrice">Precio por adulto</label>
        <input type="number" name="adultPrice" id="adultPrice" class="form-control input-sm" placeholder="Precio por adulto">
      </div>
  </div>
  <div class="servicesSelection form-group">
      <h4>Servicios incluidos</h4>
    @foreach ($allServices as $service)
    <div class="form-check">
      <input type="checkbox" class="form-check-input" id="service{{$service->id}}" name="services[]" value="{{$service->id}}">
      <label class="form-check-label" for="service{{$service->id}}">{{$service->name}}</label>
    </div>
    @endforeach
  </div>
  <div class="form-group form-row">
    <div class="col-md-3 offset-md-9">
      <input type="submit"  value="Guardar" class="btn btn-success btn-block createClient">
    </div>
  </div>
 </form>
</div>
<div class="table-responsive">
  <table id="packagesTable" class="infotable stripe">
    <thead>
        <tr>
        <th>Nombre</th>
        <th>Precio por niño</th>
        <th>Precio por adulto</th>
        <th>Cantidad mínima de personas</th>
        <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($packages as $package)
        <tr>
        <td>{{$package->name}}</td>
        <td>{{$package->kidsPrice}}</td>
        <td>{{$package->adultPrice}}</td>
        <td>{{$package->minQty}}</td>
        <td>Editar - Eliminar</td>
        </tr>
    @endforeach
    </tbody>
  </table>
</div>
<script>
  $(document).ready( function () {
    $('#packagesTable').DataTable();

    $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$('.newServiceForm').submit(function(event) {
event.preventDefault();
var formData = {
    'name': $('input[name=name]').val(),
    'kidsPrice': $('input[name=kidsPrice]').val(),
    'adultPrice': $('input[name=adultPrice]').val(),
    'minQty': $('input[name=minQty]').val(),
    'services': $('input[name=services[]]').val(),
    };
// process the form
$.ajax({
    type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
    url         : '{{url('/')}}/api/packages', // the url where we want to POST
    data        : formData // our data object
}).done(function(data) {
        $('.newServiceForm').trigger("reset");
        $('.success-message').slideToggle();
        $('.success-message').html(data.msg);
        console.log(data);
        window.location.reload();
        // here we will handle errors and validation messages
    });
});

  });
</script>
@endsection
