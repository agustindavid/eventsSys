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
        <div class="resultsTable table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>Nombre del evento</th>
                  <th>Fecha del evento</th>
                  <th>Precio cotizado</th>
                  <th>Paquete</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody class="results table-striped">
              </tbody>
            </table>
        </div>

        <form method="POST" action="{{ route('events.store') }}"  role="form">
            <p>Cotización seleccionada: <span id="quoteName"></span></p>
                <input type="hidden" name="quote_id" id="quote_id">
                {{ csrf_field() }}
                <div class="form-row form-group">
                <div class="col-md-4">
                    <label for="firstPayment">Monto del primer pago</label>
                    <input type="number" name="firstPayment" id="firstPayment" class="form-control input-sm" placeholder="Primer pago" value="{{setting('abono')}}">
                </div>
                <div class="col-md-6">
                    <label for="payMethod">Forma de pago</label>
                    <select name="payMethod" id="payMethod" class="form-control input sm">
                    <option value="">Seleccione una forma de pago</option>
                    <option value="Efectivo">Efectivo</option>
                    <option value="Tarjeta">Tarjeta</option>
                    <option value="Transferencia">Transferencia</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="receiptsQty">Cuotas</label>
                    <input type="number" name="receiptsQty" id="receiptsQty" class="form-control input-sm" placeholder="Cantidad de cuotas">
                </div>
                </div>
                <div class="form-row form-group">
                <div class="col-md-4">
                    <label for="deposit">Deposito de garantia</label>
                    <input type="number" name="deposit" id="#deposit" class="form-control input-sm" >
                </div>
                <div class="col-md-4">
                    <label for="extraPerson">Costo por persona extra</label>
                    <input type="number" name="extraPerson" id="#extraPerson" class="form-control input-sm">
                </div>
                <div class="col-md-4 align-self-end">
                    <input type="submit"  value="Guardar" class="btn btn-success btn-block">
                </div>
                </div>
            </form>
      </div>

<div class="table-responsive">
  <table id="eventsTable" class="infotable">
    <thead>
        <tr>
        <th>Nombre</th>
        <th>Paquete</th>
        <th>Cliente</th>
        <th>Locación</th>
        <th>Monto total</th>
        <th>Monto pagado</th>
        <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($events as $event)
        <tr class="data-row">
        <td>{{$event->quote->eventName}}</td>
        <td data-title="Paquete">{{$event->quote->package->name}}</td>
        <td data-title="Cliente">{{$event->quote->client->name}} {{$event->quote->client->lastname}}</td>
        <td data-title="Locación">{{$event->quote->venue->name}}</td>
        <td data-title="Monto Total">{{$event->quote->price}}</td>
        <td data-title="Acciones">{{$event->total_paid}}</td>
        <td><a href="{{url('/')}}/events/{{$event->id}}">ver detalles</a> - Eliminar</td>
        </tr>
    @endforeach
    </tbody>
  </table>
</div>
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
        url: "{{url('/')}}/api/clients", // Ajax request to get JSON from the action url
        path:"name"
        },
    },
    callback: {
        onInit: function () { console.log($(this)); },

        onClickAfter: function (node, a, item, event) {
            //console.log(item.id);
        $.get("{{url('/')}}/api/clients/"+item.id, function(data, status){
            var i=0;
            $('.results').html('');
    $.map(data, function(){
        console.log(data[i]);
        //console.log(moment().format('l'));

        $('.results').append("<tr><td>"+data[i].eventName+"</td><td>"+data[i].eventDate+"</td><td>"+data[i].price+"$</td><td>"+data[i].package.name+"</td><td><p><button href='#' class='quote-selector btn btn-primary' data-eventDate='"+data[i].eventDate+"' data-name='"+data[i].eventName+"' data-id='"+data[i].id+"' data-price='"+data[i].price+"'>Crear evento</button></p><p><a role='button' class='btn btn-info'>Ver detalles</a></p></td></tr>");
        i++;
    })

  });
        }
    }

});

$(document).on("click", ".quote-selector", function(e){
    e.preventDefault();
    $('#quote_id').val($(this).data('id'));
    $('#quoteName').html('<b>'+$(this).data('name')+'.</b> <br> Costo Total: <b>'+$(this).data('price')+'</b>');
})

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
