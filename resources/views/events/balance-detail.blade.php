@extends('layouts.sidebar')

@section('pageTitle', 'Eventos')

@section('content')
@can('gastos')
<div class="row dataInfo">
<div class="col-md-4">
  <h2>Detalles del evento</h2>
  <div class="row">
    <div class="col">
      <p>Nombre del evento: <strong>{{$event->quote->eventName}}</strong></p>
    </div>
  </div>
  <div class="row">
    <div class="col">
    <p>Cliente:<strong> {{$event->quote->client->name}} {{$event->quote->client->lastname}} </strong><small>(<a href="{{url('/')}}/clients/{{$event->quote->client->id}}">ver detalles</a>)</small></p>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <p>Salón: <strong>{{$event->quote->venue->name}}</strong></p>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <p>Fecha del evento: <strong>{!! \Carbon\Carbon::parse($event->quote->eventDate)->format('d/m/Y') !!}</strong></p>
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
      <p>Depósito de garantía: {{$event->deposit}}</p>
    </div>
</div>
              <div class="alert alert-success success-message" role="alert"></div>
        <h3>Control de gastos</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Monto</th>
                    <th>Fecha</th>
                    <th>Concepto</th>
                    <th>Número de recibo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($event->expenses as $expense)
                    <tr>
                      <td data-title="Monto">{{$expense->amount}}</td>
                      <td data-title="Fecha">{{$expense->expenseDate}}</td>
                      <td data-title="Concepto">{{$expense->concept}}</td>
                      <td data-title="Número de recibo">{{$expense->receipt}}</td>
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
@endcan




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
        window.location.reload();

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
        window.location.reload();


        // here we will handle errors and validation messages
    });
});

});

</script>

@endsection

