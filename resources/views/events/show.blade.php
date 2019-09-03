@extends('layouts.sidebar')

@section('pageTitle', 'Eventos')

@section('content')
<div class="row dataInfo">
<div class="col-md-4">
  <h2>Detalles del evento</h2>
  <div class="row">
    <div class="col">
      <p>Cliente:<strong> {{$event->quote->client->name}} {{$event->quote->client->lastname}}</strong></p>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <p>Nombre del evento: <strong>{{$event->quote->eventName}}</strong></p>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <p>Salón: <strong>{{$event->quote->venue->name}}</strong></p>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <p>Fecha de inicio: <strong>{!! \Carbon\Carbon::parse($event->quote->eventDate)->format('d-m-Y') !!}</strong></p>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <p>Hora de inicio: <strong>{{$event->quote->eventTime}}</strong></p>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <p>Fecha final: <strong>{!! \Carbon\Carbon::parse($event->quote->eventFinishDate)->format('d-m-Y') !!}</strong></p>
   </div>
  </div>
  <div class="row">
   <div class="col">
     <p>Hora final: <strong>{{$event->quote->eventFinishTime}}</strong></p>
   </div>
  </div>
  <div class="row">
    <div class="col">
      <p>Nombre del paquete seleccionado: <strong>{{$event->quote->package->name}}</strong></p>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <p>Servicios incluidos</p>
      <ul>
      @foreach($event->quote->package->services as $service)
       <li>{{$service->name}}</li>
       @endforeach
      </ul>
    </div>
  </div>
  <div class="row">
      <div class="col">
        <p>Extras:</p>
        <p>{{$event->quote->extras}}</p>
      </div>
  </div>
</div>
<div class="col-md-8">
  <div class="row">
    <div class="col">
      <h2>Resumen de cuenta:</h2>
      <p>Costo total del evento: {{$event->quote->price}}$</p>
      <p>Monto pagado hasta la fecha: {{$event->total_paid}}$</p>
      <p>Monto por pagar hasta la fecha: {{$event->quote->price-$event->total_paid}}$</p>
    </div>
</div>
        <div class="hiddenFormWrapper defaultForm" id="newPaymentWrapper">
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
                      <input type="number" step="0.01" max="{{$event->quote->price-$event->total_paid}}" min="1" name="amount" id="amount" class="form-control input-sm" placeholder="">
                    </div>
                    <div class="col">
                      <label for="payMethod">Forma de pago:</label>
                      <input type="text" name="payMethod" id="payMethod" class="form-control input-sm" placeholder="Forma de pago">
                    </div>
                  </div>
                  <div class="form-row form-group">
                    <div class="col">
                      <label for="payDate">Fecha de pago</label>
                      <input type="text" name="payDate" id="payDate" class="form-control input-sm" placeholder="Dia de pago">
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
        <h3  style="margin-top:30px;">Pagos Realizados</h3>
        <table class="table">
            <tr>
                <th>Monto pagado</th>
                <th>Fecha de pago</th>
                <th>Forma de pago</th>
                <th>Monto adeudado</th>
                <th>Total pagado</th>
                <th>Comentario</th>
            </tr>
            @foreach($event->payments->sortBy('payDate') as $payment)
              @if($payment->status==1)
                <tr>
                  <td>
                    {{$payment->amount}}
                  </td>
                  <td>
                    {!! \Carbon\Carbon::parse($payment->payDate)->format('d-m-Y') !!}
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
        <h3  style="margin-top:30px;">Pagos por realizar</h3>
        <table class="table">
          <tr>
            <th>Monto a pagar</th>
            <th>Fecha de vencimiento</th>
            <th>Acciones</th>
          </tr>
          @foreach($event->payments->sortBy('tentativeDate') as $payment)
            @if($payment->status==0)
              <tr>
                <td>
                  <p>{{$payment->toBePaid}}</p>
                </td>
                <td>
                  @if(\Carbon\Carbon::parse($payment->tentativeDate) < \Carbon\Carbon::now())
                    <span style="color:red">{!! \Carbon\Carbon::parse($payment->tentativeDate)->format('d-m-Y') !!}</span>
                  @else
                  {!! \Carbon\Carbon::parse($payment->tentativeDate)->format('d-m-Y') !!}
                  @endif
                </td>
                <td>
                  @if($payment->toBePaid < 1)
                    <button class="makePay btn btn-primary" data-amount="{{$payment->toBePaid}}" disabled data-payment="{{$payment->id}}">Realizar pago</button>
                  @else
                    <button class="makePay btn btn-primary" data-amount="{{$payment->toBePaid}}" data-payment="{{$payment->id}}">Realizar pago</button>
                  @endif
                </td>
              </tr>
            @endif
          @endforeach
        </table>
        <h4><button class="btn btn-primary makePay" href="#" class="newPaymentBtn">Registrar nuevo pago para este evento</button></h4>
        <h3>Control de gastos</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Monto</th>
                    <th>Fecha</th>
                    <th>Concepto</th>
                    <th>Numero de recibo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($event->expenses as $expense)
                    <tr>
                      <td>{{$expense->amount}}</td>
                      <td>{{$expense->expenseDate}}</td>
                      <td>{{$expense->concept}}</td>
                      <td>{{$expense->receipt}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button class="btn btn-primary newExpense">Registar gasto</button>
        <div class="hiddenFormWrapper defaultForm" id="newExpenseWrapper">
            <h3 class="panel-title">Cargar gasto</h3>
                    <form role="form" class="newExpenseForm">
                    {{ csrf_field() }}
                    <input type="hidden" name="user_id" value="1">
                    <input type="hidden" name="event_id" value="{{$event->id}}">
                      <div class="form-row form-group">
                        <div class="col">
                          <label for="amount">Monto pagado</label>
                          <input type="number" step="0.01" name="amount" id="amount" class="form-control input-sm" placeholder="">
                        </div>
                        <div class="col">
                          <label for="payDate">Fecha de pago</label>
                          <input type="text" name="expenseDate" id="expenseDate" class="form-control input-sm" placeholder="Dia de pago">
                        </div>
                      </div>
                      <div class="form-row form-group">
                        <div class="col">
                          <label for="comments">Concepto</label>
                          <textarea name="concept" id="concept" class="form-control input-sm"></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                          <input type="submit"  value="Guardar" class="btn btn-success btn-block createClient">
                          <a href="#" class="btn btn-info btn-block hiddenFormClose" >Cerrar</a>
                      </div>
                    </form>
                  </div>
      </div>
    </div>
</div>
</div>





<script>
$(document).ready(function(){

  $('.newExpense').click(function(event){
    event.preventDefault();
    $('#newExpenseWrapper').slideToggle();
  });

  $('.makePay').click(function(event) {
    event.preventDefault();
    $('#newPaymentWrapper').slideToggle();
    $('#paymentId').val($(this).data('payment'));
    $('#amount').val($(this).data('amount'));
  });

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$('#payDate').datepicker({
    format:'yyyy/mm/dd',
    language: 'es',
    endDate: 'today',
    todayHighlight: true
});

$('#expenseDate').datepicker({
    format:'yyyy/mm/dd',
    language: 'es',
    endDate: 'today',
    todayHighlight: true
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

$('.newExpenseForm').submit(function(event) {
event.preventDefault();
    requestUrl='/api/expenses';
    requestType='POST';
var formData = {
    'amount': $('input[name=amount]', this).val(),
    'expenseDate': $('input[name=expenseDate]', this).val(),
    'concept': $('textarea[name=concept]', this).val(),
    'event_id': $('input[name=event_id]', this).val()
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

});

</script>

@endsection

