@extends('layouts.sidebar')

@section('pageTitle', 'Categorías')

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
    <h3 class="panel-title">Nueva Categoría</h3>
      <form method="POST" class="newCategoryForm"  role="form">
      {{ csrf_field() }}
      <div class="form-row form-group">
        <div class="col-xs col-md-4">
            <label for="name">Nombre de la categoría</label>
          <input type="text" name="name" id="name" class="form-control input-sm" placeholder="Nombre" required>
        </div>
        <div class="col-xs col-md-4 mb1r">
          <label for="categorizable_type">Tipo de categoría</label>
          <select name="categorizable_type" id="categorizable_type" class="form-control input-sm" required>
            <option value="">Seleccione el tipo de categoría</option>
            <option value="quotes">Evento</option>
            <option value="services">Servicio</option>
          </select>
        </div>
        <div class="col-md-4 col-xs align-self-end">
            <input type="submit"  value="Guardar" class="btn btn-success btn-block createClient">
        </div>
      </div>
      </form>
</div>
<div class="alert alert-success success-message" role="alert"></div>

<h2>Categorías de servicios</h2>
<div class="table-responsive">
  <table class="stripe infotable" id="servicesCategoriesTable">
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($servicesCategories as $servicesCategory)
      <tr class="data-row">
        <td>{{$servicesCategory->name}}</td>
        <td data-title="Acciones"><a class="btn btn-outline-info" href="{{url('/')}}/categories/{{$servicesCategory->id}}/edit">Editar</a></td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>

<h2>Categorías de eventos</h2>
<div class="table-responsive">
  <table class="stripe infotable" id="quotesCategoriesTable">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($quotesCategories as $quotesCategory)
        <tr class="data-row">
            <td>{{$quotesCategory->name}}</td>
            <td data-title="Acciones"><a class="btn btn-outline-info" href="{{url('/')}}/categories/{{$quotesCategory->id}}/edit">Editar</a></td>
        </tr>
        @endforeach
    </tbody>
  </table>
</div>

<script>
$(document).ready( function () {
    $(".newCategoryForm").validate({
        lang:'es'
    });
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
$.ajax({
    type        : 'POST',
    url         : '{{url('/')}}/api/categories',
    data        : formData
}).done(function(data) {
        $('.newCategoryForm').trigger("reset");
        $('.success-message').slideToggle();
        $('.success-message').html(data.msg);
        console.log(data);
        window.location.reload();
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
