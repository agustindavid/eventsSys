@extends('layouts.sidebar')

@section('pageTitle', 'Gastos')

@section('content')


<div class="table-responsive">
  <table id="eventsTable" class="infotable">
    <thead>
        <tr>
        <th>Nombre</th>
        <th>Paquete</th>
        <th>Cliente</th>
        <th>Monto total</th>
        <th>Monto gastado</th>
        <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($events as $event)
        <tr class="data-row">
        <td>{{$event->quote->eventName}}</td>
        <td data-title="Paquete">{{$event->quote->package->name}}</td>
        <td data-title="Cliente">{{$event->quote->client->name}} {{$event->quote->client->lastname}}</td>
        <td data-title="Monto Total">{{$event->quote->price}}</td>
        <td data-title="Monto Gastado">{{$event->total_spent}}</td>
        <td data-title="Acciones"><a href="{{url('/')}}/event_balance/{{$event->id}}">ver detalle de gastos</a></td>
        </tr>
    @endforeach
    </tbody>
  </table>
</div>
<div class="container">
  {!! $chart->container() !!}
</div>

{!! $chart->script() !!}

<script>
$(document).ready( function () {
   $('#eventsTable').DataTable();
} );
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

@endsection
