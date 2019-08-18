@extends('layouts.sidebar')

@section('pageTitle', 'Eventos')

@section('content')

{{$events}}

<table id="eventsTable" class="infotable">
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($events as $event)
     <tr>
       <td>{{$event->name}}</td>
     <td><a href="/events/{{$event->id}}/edit">Editar</a> - Eliminar</td>
     </tr>
    @endforeach
    </tbody>
</table>
<script>
$(document).ready( function () {
   $('#eventsTable').DataTable();
} );
</script>

<h3 class="panel-title">Nuevo Evento</h3>
   <div class="typeahead__container">
            <div class="typeahead__field">
                <div class="typeahead__query">
     
            <input type="search" name="name" id="name" class="form-control input-sm js-typeahead-client" placeholder="Nombre" autocomplete="off">
                </div>
            </div>
   </div>
<div class="results"></div>
<form method="POST" action="{{ route('events.store') }}"  role="form">
    {{ csrf_field() }}

                <input type="number" name="quote_id" id="quote_id" class="form-control input-sm" placeholder="Cotizacion">
                <input type="number" name="receiptsQty" id="receiptsQty" class="form-control input-sm" placeholder="Cantidad de cuotas">



            <input type="submit"  value="Guardar" class="btn btn-success btn-block">
            <a href="{{ route('events.index') }}" class="btn btn-info btn-block" >Atrás</a>
</form>


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

</script>

@endsection
