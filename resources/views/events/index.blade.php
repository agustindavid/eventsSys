@extends('layouts.sidebar')

@section('pageTitle', 'Eventos')

@section('content')

<div class="defaultForm">
        <h3 class="panel-title">Nuevo Evento</h3>
        <div class="typeahead__container">
          <div class="typeahead__field">
            <div class="typeahead__query">
              <input type="search" name="name" id="name" class="form-control input-sm js-typeahead-client" placeholder="Nombre del cliente" autocomplete="off">
            </div>
          </div>
        </div>
        <div class="results"></div>
          <form method="POST" action="{{ route('events.store') }}"  role="form">
            {{ csrf_field() }}
              <div class="form-row form-group">
                <div class="col-md-6">
                  <input type="text" name="quote_name" id="quote_name" class="form-control input-sm" placeholder="Cotizacion">
                  <input type="hidden" name="quote_id" id="quote_id">
                </div>
                <div class="col-md-3">
                  <input type="number" name="receiptsQty" id="receiptsQty" class="form-control input-sm" placeholder="Cantidad de cuotas">
                </div>
                <div class="col-md-3">
                  <input type="number" name="firstPayment" id="firstPayment" class="form-control input-sm" placeholder="Primer pago">
                </div>
              </div>
              <div class="form-group">
                <input type="submit"  value="Guardar" class="btn btn-success btn-block">
                <a href="{{ route('events.index') }}" class="btn btn-info btn-block" >Atrás</a>
              </div>
         </form>
      </div>

<table id="eventsTable" class="infotable">
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Paquete</th>
        <th>Cliente</th>
        <th>Locacion</th>
        <th>Monto total</th>
        <th>Monto pagado</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($events as $event)
     <tr>
       <td>{{$event->quote->eventName}}</td>
       <td>{{$event->quote->package->name}}</td>
       <td>{{$event->quote->client->name}} {{$event->quote->client->lastname}}</td>
       <td>{{$event->quote->venue->name}}</td>
       <td>{{$event->quote->price}}</td>
       <td>{{$event->total_paid}}</td>
       <td><a href="/events/{{$event->id}}">ver detalles</a> - Eliminar</td>
     </tr>
    @endforeach
    </tbody>
</table>
<script>
$(document).ready( function () {
   $('#eventsTable').DataTable();
} );
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
        $('.results').append("<p><a href='#' class='quote-selector' data-name='"+data[i].eventName+"' data-id='"+data[i].id+"'>Usar</a>"+data[i].eventName+"<a>Ver Cotizacion</a></p>");
        i++;
    })

  });
        }
    }

});

$(document).on("click", ".quote-selector", function(e){
    e.preventDefault();
    $('#quote_id').val($(this).data('id'));
    $('#quote_name').val($(this).data('name'));
})

</script>

@endsection
