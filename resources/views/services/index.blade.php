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
          <input type="text" name="name" id="name" class="form-control input-sm" placeholder="Nombre" required>
        </div>
      </div>
      <div class="form-row form-group">
        <div class="col-xs col-md-6 mb1r">
          <label for="category_id">Categoría</label>
          <select name="category_id" id="category_id" class="form-control input-sm" required>
              <option value="">Seleccione una Categoría</option>
            @foreach ($services_categories as $service_category)
              <option value="{{$service_category->id}}">{{$service_category->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="col">
          <label for="servicePrice">Precio</label>
          <input type="text" name="servicePrice" id="servicePrice" class="form-control input-sm" placeholder="Precio" required>
        </div>
        <div class="col align-self-end">
          <input type="submit"  value="Guardar" class="btn btn-success btn-block createClient">
        </div>
      </div>
    </form>
</div>
<div class="alert alert-success success-message" role="alert"></div>
<div class="table-responsive">
  <table id="servicesTable" class="infotable">
    <thead>
    <tr>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Categoría</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($services as $service)
    <tr class="data-row">
        <td>{{$service->name}}</td>
        <td data-title="Precio">{{$service->servicePrice}}</td>
        <td data-title="Categoría">{{$service->categories->name}}</td>
        <td data-title="acciones"><a class="btn btn-outline-info" href="{{url('/')}}/services/{{$service->id}}/edit">Editar </a> - Eliminar</td>
    </tr>
    @endforeach
    </tbody>
  </table>
</div>
<script>
$(document).ready( function () {
  $('#servicesTable').DataTable();
  $(".newServiceForm").validate({
    lang:'es'
  });

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
<script>
$(document).ready(function(){
    $('.data-row').click(function(){
        if($(this).hasClass('visible-info')){
        $(this).removeClass('visible-info');
    }else{
        $('.data-row').removeClass('visible-info');
        $(this).addClass('visible-info');
    }
    });
});
</script>
@endsection
