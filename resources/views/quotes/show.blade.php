@extends('layouts.sidebar')

@section('pageTitle', 'Eventos')

@section('content')
<div class="dataInfo">
  <div class="row">
    <div class="col-md-6">
      <h3>Cotizacion para {{$quote->eventName}}</h3>
      <p>A nombre de {{$quote->client->name}} {{$quote->client->lastname}}</p>
      @if($quote->status==0)
      <p><strong>Para procesar el primer pago y crear un evento a partir de esta cotizacion haga click <a href="#" class="showHiddenForm">aqui</a></strong></p>
      <div class="hiddenFormWrapper">
        <form method="POST" action="{{ route('events.store') }}"  role="form">
            <input type="hidden" name="quote_id" id="quote_id" value={{$quote->id}}>
            {{ csrf_field() }}
            <div class="form-row form-group">
            <div class="col-md-4">
                <label for="firstPayment">Monto del primer pago</label>
                <input type="number" name="firstPayment" id="firstPayment" class="form-control input-sm" placeholder="Primer pago">
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
                <input type="number" name="deposit" id="#deposit" class="form-control input-sm">
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
          @endif
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="row">
        <div class="col">
          <p>Cliente:<strong> {{$quote->client->name}} {{$quote->client->lastname}}</strong></p>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <p>Nombre del evento: <strong>{{$quote->eventName}}</strong></p>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <p>Salón: <strong>{{$quote->venue->name}}</strong></p>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <p>Fecha de inicio: <strong>{!! \Carbon\Carbon::parse($quote->eventDate)->format('d-m-Y') !!}</strong></p>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <p>Hora de inicio: <strong>{{$quote->eventTime}}</strong></p>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <p>Fecha final: <strong>{!! \Carbon\Carbon::parse($quote->eventFinishDate)->format('d-m-Y') !!}</strong></p>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <p>Hora final: <strong>{{$quote->eventFinishTime}}</strong></p>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="row">
        <div class="col">
          <p>Nombre del paquete seleccionado: <strong>{{$quote->package->name}}</strong></p>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <p>Servicios incluidos</p>
          <ul>
          @foreach($quote->package->services as $service)
            <li>{{$service->name}}</li>
          @endforeach
          </ul>
        </div>
     </div>
     <div class="row">
       <div class="col">
         <p>Precio por niño: <strong>{{$quote->package->kidsPrice}}({{$quote->kidsQty}}) </strong></p>
         <p>Precio por adulto: <strong>{{$quote->package->adultPrice}}({{$quote->adultsQty}})</strong></p>
         <p>Precio: <strong>{{$quote->price}}</strong></>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <p>Extras: <strong>{{$quote->extrasPrice}}</strong></p>
        <p>{{$quote->extras}}</p>
      </div>
    </div>
  </div>
</div>
<script>
    $('.showHiddenForm, .hiddenFormClose').click(function(e){
        e.preventDefault();
        $('.hiddenFormWrapper').slideToggle();
    });
</script>
@endsection
