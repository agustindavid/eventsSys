@extends('layouts.sidebar')

@section('pageTitle', 'Clientes')

@section('content')

<div class="row no-margin">
    <div class="col">
        <div class="btn-wrap">
            <a class="btn btn-primary create-btn newClient" href="/clients/create">Dar de alta nuevo cliente</a>
        </div>
    </div>
</div>
<div class="defaultForm hiddenFormWrapper" id="newClientFormWrap">
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
         <tr class="data-row">
           <td data-title=""><a href="{{url('/')}}/clients/{{$client->id}}">{{$client->name}} {{$client->lastname}}</a></td>
           <td data-title="Email">{{$client->email}}</td>
         <td data-title="Acciones"><a class="btn btn-outline-info" href="{{url('/')}}/clients/{{$client->id}}/edit">Editar</a> - Eliminar</td>
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



