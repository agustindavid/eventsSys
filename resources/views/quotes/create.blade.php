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
 <h3 class="panel-title">Crear nueva cotización</h3>
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
  @include('forms.create-client')
</div>

<div class="alert alert-success success-message" role="alert"></div>

<div class="defaultForm">
  <h3 class="panel-title">Nueva Cotización</h3>
  <form method="POST" action="{{ route('quotes.store') }}" class="newQuoteForm" role="form">
  {{ csrf_field() }}
  <input type="hidden" name="parent_id" id="parent_id" class="form-control input-sm" value="32">
  <input type="hidden" name="status" id="status" class="form-control input-sm" value="0">
  <input type="hidden" name="user_id" id="user_id" class="form-control input-sm" value="1">
  <input type="hidden" name="client_id" id="client_id">
  <div class="form-group">
      <label for="clientname">Cliente <span class="reqStar">*</span></label>
      <input type="text" id="clientname" class="form-control input-sm" disabled value="">
  </div>
  <div class="form-group">
    <label for="eventName">Nombre del evento <span class="reqStar">*</span></label>
    <input type="text" name="eventName" id="eventName" class="form-control input-sm" placeholder="Nombre" required>
  </div>
  <div class="form-row form-group">
    <div class="col">
      <label for="venue_id">Locacion <span class="reqStar">*</span></label>
      <select name="venue_id" id="venue_id" class="form-control" required>
            <option value="">Selecciona una locacion</option>
        @foreach ($allVenues as $venue)
          <option data-maxcapacity="{{$venue->maxcapacity}}" value="{{$venue->id}}">{{$venue->name}}</option>
        @endforeach
      </select>
      <p class="infoText" id="maxVenuePeople"><small>Capacidad del salón: <strong><span id="maxVenuePeopleQty"></span></strong></small></p>

    </div>
    <div class="col">
      <label for="category_id">Categoria <span class="reqStar">*</span></label>
      <select name="category_id" id="category_id" class="form-control" required>
           <option value="">Seleccione una categoria</option>
        @foreach ($eventsCategories as $eventCategory)
          <option value="{{$eventCategory->id}}">{{$eventCategory->name}}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="dateGroup">
      <hr>
  <div class="form-row form-group" id="dateGroup">
    <div class="col">
      <label for="eventDate">Fecha del evento <span class="reqStar">*</span></label>
      <input type="text" name="eventDate" id="eventDate" onkeydown="return false" class="form-control input-sm date start" required  disabled  autocomplete="off" placeholder="Fecha del evento">
    </div>
    <div class="col">
      <label for="eventTime">Hora de inicio <span class="reqStar">*</span></label>
      <input name="eventTime" id="eventTime" required class="form-control input-sm time start">
    </div>
    <div class="col">
        <label for="eventFinishTime">Hora de culminación <span class="reqStar">*</span></label>
        <input type="datetime" name="eventFinishTime" required id="eventFinishTime" class="form-control input-sm time end">
      </div>
    <div class="col endDateWrap" >
      <label for="eventFinishDate">Fecha de culminación</label>
      <input type="text" name="eventFinishDate" id="eventFinishDate" class="form-control input-sm date-end" readonly="readonly"  autocomplete="off" placeholder="Fecha final del evento">
    </div>
  </div>
  <div class="row">
      <div class="col">
          <p><input name="multiDay" type="checkbox" id="multiDay"><label for="multiDay">El evento ocupa más de un día</label></p>
      </div>
  </div>
  <hr>
  <div class="form-row form-group">
    <div class="col-md-6">
      <label for="validThru">Cotización valida hasta: <span class="reqStar">*</span></label>
      <input type="text" name="validThru" id="validThru" class="form-control input-sm" readonly="readonly" required autocomplete="off" placeholder="Valido hasta">
    </div>
  </div>
  </div>
  <hr>
  <div class="form-row form-group">
    <div class="col">
      <label for="package_id">Paquete <span class="reqStar">*</span></label>
      <select name="package_id" id="package_id" class="form-control required">
          <option value="">Selecciona un paquete</option>
        @foreach ($allPackages as $package)
          <option value="{{$package->id}}" data-minQty="{{$package->minQty}}" data-kidsPrice="{{$package->kidsPrice}}" data-adultsPrice="{{$package->adultsPrice}}">{{$package->name}}</option>
        @endforeach
      </select>
      <p class="infoText" id="minPkgPeople"><small>Minimo de personas: <strong><span id="minPkgPeopleQty"></span></strong></small></p>
    </div>
    <div class="col-md-2">
      <label for="kidsQty">Niños <span class="reqStar">*</span></label>
      <input type="number" name="kidsQty" id="kidsQty" class="form-control input-sm" disabled value="0">
    </div>
    <div class="col-md-2">
        <label for="adultsQty">Adultos <span class="reqStar">*</span></label>
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
  <div class=>
      <h3>Servicios Adicionales</h3>
        <div class="addOnServices">

        </div>
  </div>
  <div class="form-row form-group">
    <div class="col-xs col-md-6 mb1r">
      <label for="extras">Adicionales</label>
      <textarea name="extras" id="extras" class="form-control input-sm" disabled></textarea>
    </div>
    <div class="col">
        <label for="extrasPrice">Monto adicional</label>
        <input type="number" name="extrasPrice" id="extrasPrice" class="form-control input-sm" disabled  value="0">
      </div>
  </div>
  <hr>
  <div class="form-group form-row">
    <div class="col-md-4 mb1r">
      <label for="price">Precio Total</label>
      <input type="text" name="price_shown" id="price_shown" disabled class="form-control input-sm">
      <input type="hidden" name="price" id="price" class="form-control input-sm" placeholder="Precio">
    </div>
    <div class="col-md-4 align-self-end offset-md-4">
        <input type="submit"  value="Crear Cotización" class="btn btn-success btn-block">
    </div>
  </div>
</form>

</div>

<script>
        function initialize() {
          var options = {
            language:'es',
            types: ['(cities)'],
            componentRestrictions: {
              country: "mx"
            }
          };

          var input = document.getElementById('autocomplete_search');
          var autocomplete = new google.maps.places.Autocomplete(input, options);
          autocomplete.addListener('place_changed', function () {
          var place = autocomplete.getPlace();
          // place variable will have all the information you are looking for.
          $('#lat').val(place.geometry['location'].lat());
          $('#long').val(place.geometry['location'].lng());
          console.log(place.address_components[0].long_name);
          console.log(place.address_components[1].long_name);
          $('#city').val(place.address_components[0].long_name)
          $('#state').val(place.address_components[1].long_name)
        });
        }

        google.maps.event.addDomListener(window, 'load', initialize);
      </script>

<script>
    // initialize input widgets first
    $('#dateGroup .time').timepicker({
        'showDuration': false,
        'timeFormat': 'H:i',
        'step': 60,
        'minTime': '10:00',
    });

    $('#dateGroup .date').datepicker({
        'format': 'yyyy/mm/dd',
        'autoclose': true,
        'startDate': "+1w",
        'language': 'es'
    });

    // initialize datepair
    $('#dateGroup').datepair();
</script>

<script>
$(document).ready(function(){
    $('#multiDay').click(function(){
        if($(this).is(":checked")){
            $('.endDateWrap').show()
        }
        else if($(this).is(":not(:checked)")){
            $('.endDateWrap').hide()        }
    });

    $('.showHiddenForm, .hiddenFormClose').click(function(e){
        e.preventDefault();
        $('.hiddenFormWrapper').slideToggle();
    });
    $('#eventDate').datepicker({}).on('changeDate', function (selected) {
        var date=$(this).val().replace(/\//g, "-");
        var venue=$('#venue_id').val();
        console.log(date);
        $.ajax({
            type: 'get',
            url: '{{url('/')}}/checkdates/'+venue+'/'+date,
        }).done(function(data) {
            console.log(data);
            if(data.status==false){
                alert('La locacion esta ocupada para la fecha seleccionada');
                $('#eventDate').val('');
            } else {
                $('#eventFinishDate').val($('#eventDate').val());
            }
        });
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
});
</script>
<script>
$('.js-typeahead-client').typeahead({
    order: "asc",
    display: ["name", "lastname", "email"],
    source: {
        name: {
        url: "{{url('/')}}/api/clients", // Ajax request to get JSON from the action url
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
    'phone': $('input[name=phone]').val(),
    'mobilePhone': $('input[name=mobilePhone]').val(),
    'dni': $('input[name=dni]').val(),
    'dniType': $('select[name=dniType]').val(),
    'number': $('input[name=number]').val(),
    'interiorNumber': $('input[name=interiorNumber]').val(),
    'street': $('input[name=street]').val(),
    'colony': $('input[name=colony]').val(),
    'postalCode': $('input[name=postalCode]').val(),
    'state': $('input[name=state]').val(),
    'city': $('input[name=city]').val()
};
// process the form
$.ajax({
    type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
    url         : '{{url('/')}}/api/clients', // the url where we want to POST
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
    url         : '{{url('/')}}/api/packages/'+item_id, // the url where we want to POST
}).done(function(data) {
        console.log(data);
        kidsPrice=data.package.kidsPrice;
        adultsPrice=data.package.adultPrice;
        minQty=data.package.minQty;
        var i=0;
        var j=0;
        $('.services-container ul').html("");
        $('.addOnServices').html("");
        $('#peopleQty').attr('min', minQty);
        $('#minPkgPeopleQty').text(minQty);
        $.map(data.package.services, function(){
        //console.log(data[i]);
          $('.services-container ul').append("<li>"+data.package.services[i].name+"</li>");
          i++;
        $('#kidsQty, #adultsQty, #peopleQty, #price').val('');
        $('#kidsQty, #adultsQty, #extras').prop('disabled', false);
        })
        $.map(data.otherServices, function(){
          $('.addOnServices').append('<div class="form-check"><input type="checkbox" class="form-check-input" id="service'+data.otherServices[j].id+'" name="services[]" value="'+ data.otherServices[j].id +'"><label class="form-check-label" for="service'+data.otherServices[j].name+'">'+data.otherServices[j].name+'</label></div>');
          j++;
        });

        // here we will handle errors and validation messages
    });
});

$('#venue_id').change(function(){
  var currentMaxQty=maxQty;
  maxQty=$(this).find(':selected').data('maxcapacity');
  if(maxQty < totalPeople){
    $('#kidsQty, #adultsQty, #peopleQty, #price, #price_shown').val('');
  }
  $('#maxVenuePeopleQty').text(maxQty+' personas');
  $('#peopleQty').attr('max', maxQty);
  $('#eventDate').prop('disabled', false);
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
    if( (totalPeople < minQty && $('#kidsQty').val() >= 1 ) && (totalPeople < minQty && $('#adultsQty').val() >= 1 )   ){
        alert("La cantidad de personas es menor a la cuota minima del paquete");
        $('#kidsQty, #adultsQty, #peopleQty, #price, #price_shown').val('');
    }
});

$(".newQuoteForm").validate({
    lang:'es'
});


</script>
@endsection
