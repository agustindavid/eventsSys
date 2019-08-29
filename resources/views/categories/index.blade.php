@extends('layouts.sidebar')

@section('pageTitle', 'Clientes')

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
    <h3 class="panel-title">Nueva Categoria</h3>
      <form method="POST" class="newCategoryForm"  role="form">
      {{ csrf_field() }}
      <div class="form-row form-group">
        <div class="col">
          <input type="text" name="name" id="name" class="form-control input-sm" placeholder="Nombre">
        </div>
        <div class="col">
          <select name="categorizable_type" id="categorizable_type" class="form-control input-sm">
            <option value="quotes">Evento</option>
            <option value="services">Servicio</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <input type="submit"  value="Guardar" class="btn btn-success btn-block createClient">
        <a href="#" class="btn btn-info btn-block clientFormClose" >Cerrar</a>
      </div>
      </form>
</div>
<div class="alert alert-success success-message" role="alert"></div>

<h2>Categorias de servicios</h2>
<table class="stripe infotable" id="servicesCategoriesTable">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Nombre corto</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($servicesCategories as $servicesCategory)
        <tr>
            <td>{{$servicesCategory->name}}</td>
            <td>{{$servicesCategory->slug}}</td>
        </tr>
        @endforeach
    </tbody>
  </table>

<h2>Categorias de eventos</h2>
<table class="stripe infotable" id="quotesCategoriesTable">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Nombre corto</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($quotesCategories as $quotesCategory)
        <tr>
            <td>{{$quotesCategory->name}}</td>
            <td>{{$quotesCategory->slug}}</td>
        </tr>
        @endforeach
    </tbody>
  </table>

<script>
$(document).ready( function () {
  var servicestable=$('#servicesCategoriesTable').DataTable();
  var quotestable=$('#quotesCategoriesTable').DataTable();

  $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$('.newCategoryForm').submit(function(event) {
event.preventDefault();
var formData = {
    'name': $('input[name=name]').val(),
    'slug': $('input[name=name]').val(),
    'categorizable_type': $('select[name=categorizable_type]').val(),
    };
// process the form
$.ajax({
    type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
    url         : '/api/categories', // the url where we want to POST
    data        : formData // our data object
}).done(function(data) {
        $('.newCategoryForm').trigger("reset");
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
