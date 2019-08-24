@extends('layouts.sidebar')

@section('pageTitle', 'Eventos')

@section('content')

<div class="dataInfo">
  <h2>Detalles del evento</h2>
  <div class="row">
    <div class="col-md-6">
      <p>{{$event->quote->client->name}} {{$event->quote->client->lastname}}</p>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <p>Nombre del evento: <strong>{{$event->quote->eventName}}</strong></p>
    </div>
    <div class="col-md-6">
      <p>Salón: <strong>{{$event->quote->venue->name}}</strong></p>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <p>Fecha de inicio</p>
      <p>{!! \Carbon\Carbon::parse($event->quote->eventDate)->format('d-m-Y') !!}</p>
    </div>
    <div class="col-md-6">
      <p>{{$event->quote->eventTime}}</p>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <p>Fecha final</p>
      <p>{!! \Carbon\Carbon::parse($event->quote->eventFinishDate)->format('d-m-Y') !!}</p>
   </div>
   <div class="col-md-6">
     <p>{{$event->quote->eventFinishTime}}</p>
   </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <p>{{$event->quote->package->name}}</p>
    </div>
    <div class="col-md-6">
      @foreach($event->quote->package->services as $service)
       <p>{{$service->name}}</p>
       @endforeach
    </div>
  </div>
    <h3>Pagos</h3>
    <div class="row">

        <p>Total: {{$event->quote->price}}</p>

    </div>
    <h4><a href="#" class="showHiddenForm">Registrar Pago:</a></h4>
    <div class="hiddenFormWrapper defaultForm">
    <h3 class="panel-title">Nuevo abono para el Evento {{$event->quote->eventName}}</h3>
            <form role="form" class="newPaymentForm">
            {{ csrf_field() }}
            <input type="hidden" name="user_id" value="1">
            <input type="hidden" name="event_id" value="{{$event->id}}">
            <input type="hidden" name="debtAmount" value="{{$event->quote->price}}">
            <input type="hidden" name="payTotal" value="0">
            <input type="hidden" name="id" id="paymentId">
              <div class="form-row form-group">
                <div class="col">
                  <label for="amount">Cantidad a abonar</label>
                  <input type="number" name="amount" id="amount" class="form-control input-sm" placeholder="">
                </div>
                <div class="col">
                  <label for="payMethod">Forma de pago:</label>
                  <input type="text" name="payMethod" id="payMethod" class="form-control input-sm" placeholder="Forma de pago">
                </div>
              </div>
              <div class="form-row form-group">
                <div class="col-md-6">
                  <label for="payDate">Fecha de pago</label>
                  <input type="date" name="payDate" id="payDate" class="form-control input-sm" placeholder="Dia de pago">
                </div>
              </div>
              <div class="form-row form-group">
                <div class="col">
                  <label for="comments">Comentarios</label>
                  <textarea name="comments" id="comments" class="form-control input-sm"></textarea>
                </div>
              </div>
              <div class="form-group">
                  <input type="submit"  value="Guardar" class="btn btn-success btn-block createClient">
                  <a href="#" class="btn btn-info btn-block hiddenFormClose" >Cerrar</a>
              </div>
            </form>
          </div>
          <div class="alert alert-success success-message" role="alert"></div>
    <h3>Pagos Realizados</h3>
    <table>
        <tr>
            <th>Monto pagado</th>
            <th>Fecha de pago</th>
            <th>Forma de pago</th>
            <th>Monto adeudado</th>
            <th>Total pagado</th>
            <th>Comentario</th>
        </tr>
        @foreach($event->payments as $payment)
          @if($payment->status==1)
            <tr>
              <td>
                {{$payment->amount}}
              </td>
              <td>
                {{$payment->payDate}}
              </td>
              <td>
                {{$payment->payMethod}}
              </td>
              <td>
                {{$payment->debtAmount}}
              </td>
              <td>
                {{$payment->payTotal}}
              </td>
              <td>
                {{$payment->comments}}
              </td>
            </tr>
          @endif
        @endforeach
    </table>
    <h3>Proyecciones</h3>
    <table>
      <tr>
        <th>Monto a pagar</th>
        <th>Fecha de vencimiento</th>
        <th>Acciones</th>
      </tr>
      @foreach($event->payments as $payment)
        @if($payment->status==0)
          <tr>
            <td>
              <p data-editable>{{$payment->amount}}</p>
            </td>
            <td>
              {!! \Carbon\Carbon::parse($payment->tentativeDate)->format('d-m-Y') !!}
            </td>
            <td>
              <button class="makePay" data-amount="{{$payment->amount}}" data-payment="{{$payment->id}}">Hacer pago</button>
            </td>
          </tr>
        @endif
      @endforeach
    </table>
  </div>
</div>

<script>
$(document).ready(function(){
  $('.showHiddenForm, .hiddenFormClose').click(function(e){
    e.preventDefault();
    $('.hiddenFormWrapper').slideToggle();
  });
  $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$('.newPaymentForm').submit(function(event) {
event.preventDefault();
var paymentID=$('input[name=id]').val();
if(paymentID != ''){
    requestType='PUT';
    requestUrl='/api/payment/'+paymentID;
} else {
    requestUrl='/api/payment';
    requestType='POST';
}
var formData = {
    'id': $('input[name=id]').val(),
    'amount': $('input[name=amount]').val(),
    'payMethod': $('input[name=payMethod]').val(),
    'payDate': $('input[name=payDate]').val(),
    'tentativeDate': $('input[name=tentativeDate]').val(),
    'debtAmount': $('input[name=debtAmount]').val(),
    'payTotal': $('input[name=payTotal]').val(),
    'comments': $('textarea[name=comments]').val(),
    'user_id': $('input[name=user_id]').val(),
    'event_id': $('input[name=event_id]').val()
};
// process the form
$.ajax({
    type        : requestType, // define the type of HTTP verb we want to use (POST for our form)
    url         : requestUrl, // the url where we want to POST
    data        : formData // our data object
}).done(function(data) {
        $('.newPaymentForm').trigger("reset");
        $('.createClient').attr('disabled', 'disabled');
        $('.hiddenFormWrapper').slideToggle();
        $('.success-message').slideToggle();
        $('.success-message').html(data.msg);
        console.log(data);

        // here we will handle errors and validation messages
    });
});

$('.makePay').click(function(event) {
  event.preventDefault();
  $('.hiddenFormWrapper').slideToggle();
  $('#paymentId').val($(this).data('payment'));
  $('#amount').val($(this).data('amount'));
});
});

</script>

@endsection

