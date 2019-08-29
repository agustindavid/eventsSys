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
 <p>Use el siguiente campo para buscar clientes existentes o <a href="#" class="showHiddenForm">Cree uno nuevo en caso de ser necesario</a></p>
   <div class="typeahead__container">
     <div class="typeahead__field">
       <div class="typeahead__query">
         <input type="search" name="clientName" id="clientName" class="form-control input-sm js-typeahead-client" placeholder="Buscar cliente" autocomplete="off">
       </div>
     </div>
   </div>

<div class="hiddenFormWrapper defaultForm">
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
        <a href="#" class="btn btn-info btn-block hiddenFormClose" >Cerrar</a>
    </div>
  </form>
</div>

<div class="alert alert-success success-message" role="alert"></div>

<div class="defaultForm">
  <h3 class="panel-title">Nueva Cotizacion</h3>
  <form method="POST" action="{{ route('quotes.store') }}"  role="form">
  {{ csrf_field() }}
  <input type="hidden" name="parent_id" id="parent_id" class="form-control input-sm" value="32">
  <input type="hidden" name="status" id="status" class="form-control input-sm" value="0">
  <input type="hidden" name="user_id" id="user_id" class="form-control input-sm" value="1">
  <input type="hidden" name="client_id" id="client_id">
  <div class="form-group">
      <label for="clientname">Cliente</label>
      <input type="text" id="clientname" class="form-control input-sm" disabled value="">
  </div>
  <div class="form-group">
    <label for="eventName">Nombre de la cotizacion</label>
    <input type="text" name="eventName" id="eventName" class="form-control input-sm" placeholder="Nombre">
  </div>
  <div class="form-row form-group">
    <div class="col">
      <label for="eventDate">Fecha del evento</label>
      <input type="text" name="eventDate" id="eventDate" class="form-control input-sm" placeholder="Fecha del evento">
    </div>
    <div class="col">
      <label for="eventTime">Hora del evento</label>
      <input type="datetime" name="eventTime" id="eventTime" class="form-control input-sm" value="2019-08-22 00:00:00">
    </div>
  </div>
  <div class="form-row form-group">
    <div class="col">
      <label for="eventFinishDate">Fecha final del evento</label>
      <input type="text" name="eventFinishDate" id="eventFinishDate" class="form-control input-sm" placeholder="Fecha final del evento">
    </div>
    <div class="col">
      <label for="eventFinishTime">Hora final del evento</label>
      <input type="datetime" name="eventFinishTime" id="eventFinishTime" class="form-control input-sm" value="2019-08-23 00:00:00">
    </div>
  </div>
  <div class="form-row form-group">
    <div class="col-md-6">
      <label for="validThru">Cotizacion valida hasta:</label>
      <input type="text" name="validThru" id="validThru" class="form-control input-sm" placeholder="Valido hasta">
    </div>
  </div>
  <div class="form-row form-group">
    <div class="col">
      <label for="venue_id">Locacion</label>
      <select name="venue_id" id="venue_id" class="form-control">
            <option value="">Selecciona una locacion</option>
        @foreach ($allVenues as $venue)
          <option data-maxcapacity="{{$venue->maxcapacity}}" value="{{$venue->id}}">{{$venue->name}}</option>
        @endforeach
      </select>
      <p class="infoText" id="maxVenuePeople">Maximo de personas: <span id="maxVenuePeopleQty"></span></p>

    </div>
    <div class="col">
      <label for="category_id">Categoria</label>
      <select name="category_id" id="category_id" class="form-control">
        @foreach ($eventsCategories as $eventCategory)
          <option value="{{$eventCategory->id}}">{{$eventCategory->name}}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="form-row form-group">
    <div class="col">
      <label for="package_id">Paquete</label>
      <select name="package_id" id="package_id" class="form-control">
          <option value="">Selecciona un paquete</option>
        @foreach ($allPackages as $package)
          <option value="{{$package->id}}" data-minQty="{{$package->minQty}}" data-kidsPrice="{{$package->kidsPrice}}" data-adultsPrice="{{$package->adultsPrice}}">{{$package->name}}</option>
        @endforeach
      </select>
      <p class="infoText" id="minPkgPeople">Minimo de personas: <span id="minPkgPeopleQty"></span></p>
    </div>
    <div class="col-md-2">
      <label for="kidsQty">Niños</label>
      <input type="number" name="kidsQty" id="kidsQty" class="form-control input-sm" disabled value="0">
    </div>
    <div class="col-md-2">
        <label for="adultsQty">Adultos</label>
        <input type="number" name="adultsQty" id="adultsQty" class="form-control input-sm" disabled value="0">
      </div>
      <div class="col-md-2">
        <label for="peopleQty">Total</label>
        <input type="number" name="peopleQty" min="1" id="peopleQty" class="form-control input-sm" readonly placeholder="">
      </div>
  </div>
  <div class="services-container">
    <h3>Servicios Incluidos</h3>
    <ul>

    </ul>
  </div>
  <div class="form-row form-group">
    <div class="col">
      <label for="extras">Adicionales</label>
      <textarea name="extras" id="extras" class="form-control input-sm" disabled></textarea>
    </div>
    <div class="col">
        <label for="extrasPrice">Precio adicionales</label>
        <input type="number" name="extrasPrice" id="extrasPrice" class="form-control input-sm" disabled  value="0">
      </div>
  </div>
  <div class="form-group">
    <label for="price">Precio</label>
    <input type="text" name="price_shown" id="price_shown" disabled class="form-control input-sm">
    <input type="hidden" name="price" id="price" class="form-control input-sm" placeholder="Precio">
</div>
  <div class="form-group">
    <input type="submit"  value="Guardar" class="btn btn-success btn-block">
    <a href="{{ route('quotes.index') }}" class="btn btn-info btn-block" >Atrás</a>
  </div>
</form>
</div>
<script>
    $(document).ready(function(){
        $('.showHiddenForm, .hiddenFormClose').click(function(e){
            e.preventDefault();
            $('.hiddenFormWrapper').slideToggle();
        });
    })
    $('#eventDate').datepicker({
        format:'yyyy/mm/dd',
        startDate: "+1w",
        language: 'es'
    }).on('changeDate', function (selected) {
        if($('#eventFinishDate').val() != ''){
          var auxDate=$('#eventFinishDate').val();
          var eventFinishDate=Date.parse(auxDate);
          eventFinishDate=new Date(eventFinishDate);
          var eventDate=Date.parse($(this).val());
          if(eventFinishDate < eventDate){
            alert('La fecha final del evento debe ser mayor a la fecha de inicio');
            $('#eventFinishDate').val('');
          }
        }
        var minDate = new Date(selected.date.valueOf());
        $('#eventFinishDate').datepicker('setStartDate', minDate);
    });;


    $('#eventFinishDate').datepicker({
        format:'yyyy/mm/dd',
        language: 'es'
    });

    $('#validThru').datepicker({
        format:'yyyy/mm/dd',
        endDate: "+1m",
        language: 'es'
    });

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
          $('#client_id').val(item.id);
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
        $('#clientname').val(data.cliente.name+' '+data.cliente.lastname);
        $('#client_id').val(data.cliente.id);
        console.log(data);


        // here we will handle errors and validation messages
    });
});

var kidsPrice;
var adultsPrice;
var minQty;
var maxQty;
var totalPeople;

$('#package_id').change(function(){
            //$('#price').val(packagePrice);
            //$('#price_shown').val(packagePrice);
    var item_id=$(this).val();
    $.ajax({
    type        : 'get', // define the type of HTTP verb we want to use (POST for our form)
    url         : '/api/packages/'+item_id, // the url where we want to POST
}).done(function(data) {
        console.log(data);
        kidsPrice=data.package.kidsPrice;
        adultsPrice=data.package.adultPrice;
        minQty=data.package.minQty;
        var i=0;
        $('.services-container ul').html("");
        $('#peopleQty').attr('min', minQty);
        $('#minPkgPeopleQty').text(minQty);
        $.map(data.package.services, function(){
        //console.log(data[i]);
        $('.services-container ul').append("<li>"+data.package.services[i].name+"</li>");
        i++;
        console.log(kidsPrice);
        console.log(adultsPrice);
        $('#kidsQty, #adultsQty, #peopleQty, #price').val('');
        $('#kidsQty, #adultsQty, #extras').prop('disabled', false);
    })
        // here we will handle errors and validation messages
    });
});

$('#venue_id').change(function(){
  var currentMaxQty=maxQty;
  maxQty=$(this).find(':selected').data('maxcapacity');
  if(maxQty < totalPeople){
    $('#kidsQty, #adultsQty, #peopleQty, #price, #price_shown').val('');
  }
  $('#maxVenuePeopleQty').text(maxQty);
  $('#peopleQty').attr('max', maxQty);
});

$('#extras').change(function(){
    if($(this).val() != ''){
      $('#extrasPrice').prop('disabled', false);
    } else {
        $('#extrasPrice').prop('disabled', true)
    }
});

$('#kidsQty, #adultsQty, #extrasPrice').keyup(function(){
    totalKids=$('#kidsQty').val();
    totalAdults=$('#adultsQty').val();
    extrasPrice=$('#extrasPrice').val();
    totalPrice = (kidsPrice * totalKids*1 + adultsPrice * totalAdults*1) + extrasPrice*1;
    totalPeople=totalKids*1 + totalAdults*1;
    $('#peopleQty').val(totalPeople);
    $('#price').val(totalPrice);
    $('#price_shown').val(totalPrice);
})

$('#kidsQty, #adultsQty').change(function(){
    if(totalPeople > maxQty){
        alert("La cantidad de personas es mayor a la capacidad del salon");
        $('#kidsQty, #adultsQty, #peopleQty, #price, #price_shown').val('');
    }
    if( (totalPeople < minQty && $('#kidsQty').val() > 1 ) && (totalPeople < minQty && $('#adultsQty').val() > 1 )   ){
        alert("La cantidad de personas es menor a la cuota minima del paquete");
        $('#kidsQty, #adultsQty, #peopleQty, #price, #price_shown').val('');
    }
});



</script>
@endsection
