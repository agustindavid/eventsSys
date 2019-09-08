@extends('layouts.sidebar')

@section('pageTitle', 'Servicios')

@section('content')

<div class="defaultForm">
  @if (count($errors) > 0)
    <div class="alert alert-danger">
      <strong>Error!</strong> Revise los campos obligatorios.<br><br>
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  @if(Session::has('success'))
  <div class="alert alert-info">
    {{Session::get('success')}}
  </div>
  @endif
    <h3 class="panel-title">Nuevo servicio</h3>
    <form method="POST" class="newServiceForm"  role="form">
      {{ csrf_field() }}
      <div class="form-row form-group">
        <div class="col">
          <label for="name">Nombre del servicio</label>
          <input type="text" name="name" id="name" class="form-control input-sm" placeholder="Nombre">
        </div>
      </div>
      <div class="form-row form-group">
        <div class="col">
          <label for="category_id">Categoría</label>
          <select name="category_id" id="category_id" class="form-control input-sm">
              <option value="">Seleccione una Categoría</option>
            @foreach ($services_categories as $service_category)
              <option value="{{$service_category->id}}">{{$service_category->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="col">
          <label for="servicePrice">Precio</label>
          <input type="text" name="servicePrice" id="servicePrice" class="form-control input-sm" placeholder="Precio">
        </div>
        <div class="col align-self-end">
          <input type="submit"  value="Guardar" class="btn btn-success btn-block createClient">
        </div>
      </div>
    </form>
</>
<div class="alert alert-success success-message" role="alert"></div>
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
       <td>{{$service->name}}</td>
       <td>{{$service->servicePrice}}</td>
       <td>{{$service->categories->name}}</td>
     <td>Editar - Eliminar</td>
     </tr>
    @endforeach
    </tbody>
</table>
<script>
$(document).ready( function () {
  $('#servicesTable').DataTable();

  $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$('.newServiceForm').submit(function(event) {
event.preventDefault();
var formData = {
    'name': $('input[name=name]').val(),
    'servicePrice': $('input[name=servicePrice]').val(),
    'category_id': $('select[name=category_id]').val(),
    };
// process the form
$.ajax({
    type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
    url         : '{{url('/')}}/api/services', // the url where we want to POST
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
