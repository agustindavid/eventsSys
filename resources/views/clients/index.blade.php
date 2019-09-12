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
    @include('forms.create-client')
</div>
      <div class="alert alert-success success-message" role="alert"></div>
  <div class="table-responsive">
      <table id="clientsTable" class="infotable stripe">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Correo Electrónico</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($clients as $client)
         <tr>
           <td>{{$client->name}} {{$client->lastname}} <small>(<a href="{{url('/')}}/clients/{{$client->id}}">Ver detalles</a>)</small></td>
           <td>{{$client->email}}</td>
           <td>Editar - Eliminar</td>
         </tr>
        @endforeach
        </tbody>
    </table>
  </div>

<script>
$(document).ready( function () {
    var table=$('#clientsTable').DataTable();
$('.newClient').click(function(e){
    e.preventDefault();
    $('#newClientFormWrap').slideToggle();
})

$('.clientFormClose').click(function(e){
    e.preventDefault(e);
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
    'dniType': $('select[name=dniType]').val(),
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
    url         : '{{url('/')}}/api/clients', // the url where we want to POST
    data        : formData // our data object
}).done(function(data) {
        $('.newClientForm').trigger("reset");
        $('.success-message').slideToggle();
        $('.success-message').html(data.msg);
        console.log(data);
        window.location.reload();

        // here we will handle errors and validation messages
    });
});

} );

</script>

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
@endsection



