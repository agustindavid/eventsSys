@extends('layouts.sidebar')

@section('pageTitle', 'services')

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
    <div class="typeahead__container">
             <div class="typeahead__field">
                 <div class="typeahead__query">
      
             <input type="search" name="name" id="name" class="form-control input-sm js-typeahead-client" placeholder="Nombre" autocomplete="off">
                 </div>
             </div>
    </div>
         <h3 class="panel-title">Nuevo Cliente</h3>
         <form method="POST" role="form" class="newClientForm">
             {{ csrf_field() }}
                         <input type="text" name="name" id="name" class="form-control input-sm" placeholder="Nombre">
                         <input type="text" name="lastname" id="lastname" class="form-control input-sm" placeholder="Apellido">
                         <input type="text" name="email" id="email" class="form-control input-sm" placeholder="Correo Electronico">
                         <input type="text" name="rfc" id="rfc" class="form-control input-sm" placeholder="RFC">
                         <input type="text" name="fiscalname" id="fiscalname" class="form-control input-sm" placeholder="Nombre Fiscal">
                         <input type="text" name="commercialname" id="commercialname" class="form-control input-sm" placeholder="Nombre Comercial">
                         <input type="text" name="phone" id="phone" class="form-control input-sm" placeholder="Telefono">
                     <input type="submit"  value="Guardar" class="btn btn-success btn-block">
                     <a href="{{ route('clients.index') }}" class="btn btn-info btn-block" >Atrás</a>
         </form>
             <form method="POST" action="{{ route('quotes.store') }}"  role="form">
                 {{ csrf_field() }}
                              <input type="text" name="parent_id" id="parent_id" class="form-control input-sm" value="32">
                             <input type="text" name="eventName" id="eventName" class="form-control input-sm" placeholder="Nombre">
                             <input type="date" name="eventDate" id="eventDate" class="form-control input-sm" placeholder="Fecha del evento">
                             <input type="datetime" name="eventTime" id="eventTime" class="form-control input-sm" value="2019-08-22 00:00:00">
                             <input type="date" name="eventFinishDate" id="eventFinishDate" class="form-control input-sm" placeholder="Fecha final del evento">
                             <input type="datetime" name="eventFinishTime" id="eventFinishTime" class="form-control input-sm" value="2019-08-23 00:00:00">
                             <input type="text" name="price" id="price" disabled class="form-control input-sm" placeholder="Precio">
                             <input type="text" name="status" id="status" class="form-control input-sm" placeholder="Estado">
                             <input type="text" name="peopleQty" id="peopleQty" class="form-control input-sm" placeholder="Cantidad de personas">
                             <input type="date" name="validThru" id="validThru" class="form-control input-sm" placeholder="Valido hasta">
                             <input type="text" name="user_id" id="user_id" class="form-control input-sm" value="1">
                             Paquete <br>
                             <select name="package_id" id="package_id">
                             @foreach ($allPackages as $package)
                             <option value="{{$package->id}}" data-price="{{$package->price}}">{{$package->name}}</option>
                             @endforeach
                         </select>
                             Cliente <br>
                             <select name="client_id" id="client_id">
                             @foreach ($allClients as $client)
                                <option value="{{$client->id}}">{{$client->name}} {{$client->lastname}}</option>
                             @endforeach
                         </select>
                              Locacion <br>
                                 <select name="venue_id" id="venue_id">
                                 @foreach ($allVenues as $venue)
                                    <option value="{{$venue->id}}">{{$venue->name}}</option>
                                 @endforeach
                             </select>
                                      Categoria <br>
                                         <select name="category_id" id="category_id">
                                         @foreach ($eventsCategories as $eventCategory)
                                            <option value="{{$eventCategory->id}}">{{$eventCategory->name}}</option>
                                         @endforeach
                                     </select>
                         <input type="submit"  value="Guardar" class="btn btn-success btn-block">
                         <a href="{{ route('quotes.index') }}" class="btn btn-info btn-block" >Atrás</a>
             </form>
             <script>
                 $(document).ready(function(){
                     $('#package_id').change(function(){
                         var packagePrice=$(this).find(':selected').data('price');
                         $('#price').val(packagePrice);
                     })
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
                         $.get("http://localhost:8000/api/clients/"+item.id, function(data, status){
                             var i=0;
                     $.map(data, function(){
                         console.log(data[i]);
                         $('.results').append("<p><a href='#' class='quote-selector' data-id='"+data[i].id+"'>Usar</a>"+data[i].eventName+"<a>Ver Cotizacion</a></p>");
                         i++;
                     })
                   });
                         }
                     }
                 });
$('newClientForm').submit(function(event) {
// get the form data
// there are many ways to get this data using jQuery (you can use the class or id also)
var formData = {
    'name': $('input[name=name]').val(),
    'name': $('input[name=lastname]').val(),
    'email': $('input[name=email]').val(),
    'rfc': $('input[name=rfc]').val()
    'fiscalname': $('input[name=fiscalname]').val()
    'commercialname': $('input[name=commercialname]').val()
    'phone': $('input[name=phone]').val()
};

// process the form
$.ajax({
    type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
    url         : '/api/clients', // the url where we want to POST
    data        : formData, // our data object
    dataType    : 'json', // what type of data do we expect back from the server
                encode          : true
})
    // using the done promise callback
    .done(function(data) {

        // log data to the console so we can see
        console.log(data);

        // here we will handle errors and validation messages
    });

// stop the form from submitting the normal way and refreshing the page
event.preventDefault();
});

});

                            </script>
@endsection
