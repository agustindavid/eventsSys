@extends('layouts.sidebar')

@section('pageTitle', 'Crear Cotizacion')

@section('content')

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
 <h3 class="panel-title">Crear nueva cotizacion</h3>
 <p>Use el siguiente campo para buscar clientes existentes o <a href="#" class="showClientForm">Cree uno nuevo en caso de ser necesario</a></p>
   <div class="typeahead__container">
     <div class="typeahead__field">
       <div class="typeahead__query">
         <input type="search" name="clientName" id="clientName" class="form-control input-sm js-typeahead-client" placeholder="Nombre" autocomplete="off">
       </div>
     </div>
   </div>

<div class="clientFormWrapper">
  <h3 class="panel-title">Nuevo Cliente</h3>
  <form role="form" class="newClientForm">
  {{ csrf_field() }}
    <div class="form-group">
      <label for="name">Nombre</label>
      <input type="text" name="name" id="name" class="form-control input-sm" placeholder="Nombre">
    </div>
    <div class="form-group">
      <label for="lastname">Apellido</label>
      <input type="text" name="lastname" id="lastname" class="form-control input-sm" placeholder="Apellido">
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="text" name="email" id="email" class="form-control input-sm" placeholder="Correo Electronico">
    </div>
    <div class="form-group">
      <label for="rfc">RFC</label>
      <input type="text" name="rfc" id="rfc" class="form-control input-sm" placeholder="RFC">
    </div>
    <div class="form-group">
      <label for="fiscalname">Nombre Fiscal</label>
      <input type="text" name="fiscalname" id="fiscalname" class="form-control input-sm" placeholder="Nombre Fiscal">
    </div>
    <div class="form-group">
        <label for="commercialname">Nombre Comercial</label>
        <input type="text" name="commercialname" id="commercialname" class="form-control input-sm" placeholder="Nombre Comercial">
    </div>
    <div class="form-group">
        <label for="phone">Telefono</label>
        <input type="text" name="phone" id="phone" class="form-control input-sm" placeholder="Telefono">
    </div>
    <div class="form-group">
        <input type="submit"  value="Guardar" class="btn btn-success btn-block createClient">
        <a href="{{ route('clients.index') }}" class="btn btn-info btn-block" >Cerrar</a>
    </div>
  </form>
</div>
<div class="alert alert-success success-message" role="alert"></div>
<div class="defaultForm">
  <form method="POST" action="{{ route('quotes.store') }}"  role="form">
  {{ csrf_field() }}
  <input type="hidden" name="parent_id" id="parent_id" class="form-control input-sm" value="32">
  <input type="hidden" name="status" id="status" class="form-control input-sm" value="0">
  <input type="hidden" name="user_id" id="user_id" class="form-control input-sm" value="1">
  <input type="hidden" name="client_id" id="client_id">
  <div class="form-group">
      <label for="clientname">Cliente</label>
      <input type="text" id="clientname" disabled value="">
  </div>
  <div class="form-group">
    <label for="eventName">Nombre de la cotizacion</label>
    <input type="text" name="eventName" id="eventName" class="form-control input-sm" placeholder="Nombre">
  </div>
  <div class="form-group">
    <label for="eventDate">Fecha del evento</label>
    <input type="date" name="eventDate" id="eventDate" class="form-control input-sm" placeholder="Fecha del evento">
  </div>
  <div class="form-group">
    <label for="eventTime">Hora del evento</label>
    <input type="datetime" name="eventTime" id="eventTime" class="form-control input-sm" value="2019-08-22 00:00:00">
  </div>
  <div class="form-group">
    <label for="eventFinishDate">Fecha final del evento</label>
    <input type="date" name="eventFinishDate" id="eventFinishDate" class="form-control input-sm" placeholder="Fecha final del evento">
  </div>
  <div class="form-group">
    <label for="eventFinishTime">Hora final del evento</label>
    <input type="datetime" name="eventFinishTime" id="eventFinishTime" class="form-control input-sm" value="2019-08-23 00:00:00">
  </div>
  <div class="form-group">
        <label for="eventFinishTime">Cotazacion valida hasta:</label>
        <input type="date" name="validThru" id="validThru" class="form-control input-sm" placeholder="Valido hasta">
  </div>
  <div class="form-group">
      <label for="package_id">Paquete</label>
    <select name="package_id" id="package_id">
      @foreach ($allPackages as $package)
        <option value="{{$package->id}}" data-price="{{$package->price}}">{{$package->name}}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group">
      <label for="price">Precio</label>
      <input type="text" name="price" id="price" disabled class="form-control input-sm" placeholder="Precio">
  </div>
  <div class="form-group">
        <label for="peopleQty">Cantidad de personas</label>
        <input type="text" name="peopleQty" id="peopleQty" class="form-control input-sm" placeholder="Cantidad de personas">
  </div>
  <div class="form-group">
    <label for="venue_id">Locacion</label>
    <select name="venue_id" id="venue_id">
      @foreach ($allVenues as $venue)
        <option value="{{$venue->id}}">{{$venue->name}}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group">
      <label for="category_id">Categoria</label>
      <select name="category_id" id="category_id">
        @foreach ($eventsCategories as $eventCategory)
          <option value="{{$eventCategory->id}}">{{$eventCategory->name}}</option>
        @endforeach
      </select>
  </div>
  <div class="form-group">
    <input type="submit"  value="Guardar" class="btn btn-success btn-block">
    <a href="{{ route('quotes.index') }}" class="btn btn-info btn-block" >Atrás</a>
  </div>
</form>
</div>
<script>
    $(document).ready(function(){
        $('#package_id').change(function(){
            var packagePrice=$(this).find(':selected').data('price');
            $('#price').val(packagePrice);
        })

        $('.showClientForm').click(function(){
            $('.clientFormWrapper').slideToggle();
        });
    })
</script>
<script>
$('.js-typeahead-client').typeahead({
    order: "asc",
    display: ["name", "lastname", "email"],
    source: {
        name: {
        url: "http://localhost:8000/api/clients", // Ajax request to get JSON from the action url
        path:"name"
        },
    },
    callback: {
        onInit: function () { console.log($(this)); },
        onClickAfter: function (node, a, item, event) {
            //console.log(item.id);
          $('#parent_id').val(item.id);
          $('#clientname').val(item.name+' '+item.lastname);
        }
    }
});
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
        $('.createClient').attr('disabled', 'disabled');
        $('.clientFormWrapper').slideToggle();
        $('.success-message').slideToggle();
        $('.success-message').html(data.msg);
        console.log(data);

        // here we will handle errors and validation messages
    });
});
</script>
@endsection
