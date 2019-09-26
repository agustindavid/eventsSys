@extends('layouts.sidebar')

@section('pageTitle', 'Eventos')

@section('content')
<div class="row dataInfo">
    <h2>Resumen de Evento aprobado</h2>
  <div class="card-columns">
    <div class="card shadow">
      <div class="card-header">
        Detalles del evento
      </div>
      <div class="card-body">
        <p class="card-text">
          <p>Nombre del evento: <strong>{{$event->quote->eventName}}</strong></p>
          <p>Cliente:<strong> {{$event->quote->client->name}} {{$event->quote->client->lastname}} </strong></p>
          <p>Salón: <strong>{{$event->quote->venue->name}}</strong></p>
          <p>Fecha y hora: <strong>{!! \Carbon\Carbon::parse($event->quote->eventDate)->format('d/m/Y') !!} a las {!! \Carbon\Carbon::parse($event->quote->eventTime)->isoFormat('h:mm a') !!}</strong></p>
          <p>Hasta: <strong>{!! \Carbon\Carbon::parse($event->quote->eventFinishDate)->format('d/m/Y') !!} a las {!! \Carbon\Carbon::parse($event->quote->eventFinishTime)->isoFormat('h:mm a') !!}</strong></p>
          <p>Duracion: <strong>{{$event->duration}} Horas</strong></p>
          <p>Cantidad de personas: <strong>{{$event->quote->peopleQty}}</strong></p>
          <p>Niños: <strong>{{$event->quote->kidsQty}}</strong> +</p>
          <p>Adultos: <strong>{{$event->quote->adultsQty}}</strong> +</p>
          <p><a href="{{url('/')}}/generate-contract/{{$event->id}}" class="btn btn-primary"><i class="far fa-file-alt icon-btn"></i>Descargar contrato</a></p>
        </p>
       </div>
    </div>
    <div class="card shadow">
      <div class="card-header">
        Resumen de cuenta:
      </div>
      <div class="card-body">
        <p class="card-text">
          <p>Costo de la cotización: {{$event->quote->price}}$</p>
          <p>Costo total del evento: {{$event->price}}$</p>
          <p>Monto pagado hasta la fecha: {{$event->total_paid}}$</p>
          <p>Monto por pagar hasta la fecha: {{$event->price-$event->total_paid}}$</p>
          <p>Depósito de garantía: {{$event->deposit}}</p>
        </p>
      </div>
    </div>
    <div class="card shadow">
      <div class="card-header">
        Paquete y servicios incluidos
      </div>
      <div class="card-body">
        <p class="card-text">
          <p>Paquete: <strong>{{$event->quote->package->name}}</strong></p>
          <p>Servicios incluidos</p>
           <ul>
           @foreach($event->quote->package->services as $service)
             <li>{{$service->name}}</li>
           @endforeach
           </ul>
        </p>
      </div>
    </div>
    <div class="card shadow">
      <div class="card-header">
        Servicios Exclusivos
      </div>
      <div class="card-body">
        <p class="card-text">
          <ul>
          @foreach($event->quote->services as $q_service)
            <li>{{$q_service->name}}: {{$q_service->pivot->price}}</li>
          @endforeach
          @foreach ($event->services as $service)
            <li>{{$service->name}}: {{$service->pivot->price}}</li>
          @endforeach
          </ul>
          <a href="#" class="btn btn-primary showForm" data-form="newChargeWrapper" ><i class="fas fa-concierge-bell icon-btn" aria-hidden="true"></i> Agregar servicio</a>
        </p>
      </div>
    </div>
    <div class="card shadow">
      <div class="card-header">
        Balance
      </div>
      <div class="card-body">
        {!! $chart->container() !!}
        {!! $chart->script() !!}
      </div>
    </div>
    <div class="card shadow">
      <div class="card-header">
        Tiempo restante para el evento
      </div>
      <div class="card-body clock-bg">
        <div id="clockdiv">
         <div class="clock-wrap">
          <div>
            <span class="days"></span>
            <div class="smalltext">Dias</div>
          </div>
          <div>
            <span class="hours"></span>
            <div class="smalltext">Horas</div>
          </div>
          <div>
            <span class="minutes"></span>
            <div class="smalltext">Minutos</div>
          </div>
         </div>
        </div>
      </div>
    </div>
    <div class="card shadow">
      <div class="card-header">
         Detalles del cliente
      </div>
      <div class="card-body">
        <p class="card-text">
          <p>Nombre: <strong>{{$event->quote->client->name}} {{$event->quote->client->lastname}}</strong></p>
          <p>Teléfono: <strong>{{$event->quote->client->phone}}</strong></p>
          <p>Teléfono celular: <strong>{{$event->quote->client->mobilePhone}}</strong></p>
          <p>RFC: <strong>{{$event->quote->client->rfc}}</strong></p>
          <p>Ciudad: <strong>{{$event->quote->client->city}}</strong></p>
          <p>Estado: <strong>{{$event->quote->client->state}}</strong></p>
        </p>
      </div>
    </div>
  </div>

        <h3  style="margin-top:30px;">Pagos Realizados</h3>
        <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>Monto pagado</th>
                <th>Número de pago</th>
                <th>Fecha de pago</th>
                <th>Forma de pago</th>
                <th>Monto adeudado</th>
                <th>Total pagado</th>
                <th>Imprimir</th>
                <th>Comentario</th>
            </tr>
            </thead>
            @foreach($event->payments->sortBy('payDate') as $payment)
              @if($payment->status==1)
              <tbody>
                <tr class="data-row">
                  <td>
                    {{$payment->amount}}
                  </td>
                  <td>
                    {{setting('payment_prefix')}}{{$payment->id}}
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
                    <a href="{{url('/')}}/print-payment/{{$payment->id}}"><i class="fas fa-print"></i></a>
                  </td>
                  <td>
                    {{$payment->comments}}
                  </td>
                </tr>
              </tbody>
              @endif
            @endforeach
        </table>
        </div>
        <h3  style="margin-top:30px;">Pagos por realizar</h3>
        <div class="table-responsive">
        <table class="table">
          <tr>
            <th>Monto a pagar</th>
            <th>Fecha de vencimiento</th>
            <th>Acciones</th>
          </tr>
          @foreach($event->payments->sortBy('tentativeDate') as $payment)
            @if($payment->status==0)
              <tr class="data-row">
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
                    <button class="makePay btn btn-primary" data-form="newPaymentWrapper" data-amount="{{$payment->toBePaid}}" data-payment="{{$payment->id}}">Realizar pago</button>
                  @endif
                </td>
              </tr>
            @endif
          @endforeach
        </table>
        </div>
        <div class="slideInForm defaultForm" id="newPaymentWrapper">
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
                                <label for="payMethod">Forma de pago</label>
                                <select name="payMethod" id="payMethod" class="form-control input sm">
                                <option value="">Seleccione una forma de pago</option>
                                <option value="Efectivo">Efectivo</option>
                                <option value="Tarjeta">Tarjeta</option>
                                <option value="Transferencia">Transferencia</option>
                                </select>
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
        <div class="defaultForm slideInForm" id="newChargeWrapper">
                <h3 class="panel-title">Nuevo cargo para el Evento {{$event->quote->eventName}}</h3>
                        <form role="form" class="newChargeForm">
                        {{ csrf_field() }}
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        <input type="hidden" name="event_id" value="{{$event->id}}">
                          <div class="form-group form-row">
                            <div class="specialServices col">
                                @foreach ($specialServices as $s_service)
                                <div class="form-check row no-margin">
                                    <input type="checkbox" class="form-check-input extraServiceCheck" id="service-{{$s_service->id}}" name="services[]" value="{{$s_service->id}}">
                                    <label class="form-check-label" for="service-{{$s_service->id}}">{{$s_service->name}}</label><br>
                                    <label class="extraServicePriceLabel"  for="servicePrice-{{$s_service->id}}">Precio del servicio</label>
                                    <input type="number" min="0" class="extraServicePrice form-control input-sm" name="{{$s_service->id}}" id="servicePrice-{{$s_service->id}}" value="{{$s_service->servicePrice}}">
                                    <div class="clearfix"></div>
                                </div>
                                @endforeach
                            </div>
                          </div>
                          <div class="form-row form-group">
                                <div class="col">
                                  <label for="comments">Otro concepto</label>
                                  <textarea name="comments" id="comments" class="form-control input-sm"></textarea>
                                </div>
                              </div>
                          <div class="form-row form-group">
                            <div class="col-md-6 offset-md-6">
                              <label for="amount">Monto del cargo</label>
                              <input class="chargeAmount" type="number" step="0.01"  min="1" name="amount" id="amount" class="form-control input-sm" placeholder="">
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





<script>
$(document).ready(function(){

  $('.showForm').click(function(event){
    event.preventDefault();
    var form=$(this).data('form');
    $('#'+form).addClass('visible');
    displayOverlay();
  });

  function displayOverlay(){
      $('.modal-overlay').css('display', 'block');
  }

  function hideOverlay(){
      $('.modal-overlay').css('display', 'none');
  }

  $('.hiddenFormClose').click(function(event){
    event.preventDefault();
    $('.slideInForm').removeClass('visible');
    hideOverlay();
  });

  $('.newExpense').click(function(event){
    event.preventDefault();
    $('#newExpenseWrapper').slideToggle();
  });

  $('.makePay').click(function(event) {
    event.preventDefault();
    $('#newPaymentWrapper').addClass('visible');
    $('#paymentId').val($(this).data('payment'));
    $('#amount').val($(this).data('amount'));
    displayOverlay();
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
    startDate:'-1m',
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
    requestUrl='{{url('/')}}/api/payment/'+paymentID;
  } else {
    requestUrl='{{url('/')}}/api/payment';
    requestType='POST';
  }
  var formData = {
    'id': $('input[name=id]').val(),
    'amount': $('input[name=amount]').val(),
    'payMethod': $('select[name=payMethod]').val(),
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

function countExtras(){
    var result=0;
    if($('.extraServiceCheck:checked ~.extraServicePrice')){
    $('.extraServiceCheck:checked ~.extraServicePrice').each(function(){
        result += Number($(this).val());
    });
      return result;
    }else{
      return 0;
    }
}

var extrasTotal;
$('.extraServiceCheck').click(function(){
    extrasTotal=countExtras();
    //console.log(extrasTotal);
    $('.chargeAmount').val(extrasTotal);
})

$('.newChargeForm').submit(function(event) {
  event.preventDefault();

var checks =[];
var prices=[];
var i=0;
  $('.extraServiceCheck:checked').each(function(){
    var checkedPrice=$('~.extraServicePrice', this).val();
    checks.push([$(this).val(), checkedPrice]);
    prices[$(this).val()]=checkedPrice;
    i++;
  })

  console.log(checks);

  var formData = {
    'services': checks,
    'amount': $('input[name=amount]', this).val(),
    'comments': $('textarea[name=comments]', this).val(),
    'user_id': $('input[name=user_id]', this).val(),
    'event_id': $('input[name=event_id]', this).val(),
    'servicesPrices': 1
  };
// process the form
$.ajax({
    type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
    url         : requestUrl='{{url('/')}}/api/add-charge', // the url where we want to POST
    data        : formData // our data object
}).done(function(data) {
        $('.newChargeForm').trigger("reset");
        $('.success-message').slideToggle();
        $('.success-message').html(data.msg);
        console.log(data);
        window.location.reload();

       // here we will handle errors and validation messages
    });
});

$('.newExpenseForm').submit(function(event) {
event.preventDefault();
    requestUrl='{{url('/')}}/api/expenses';
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

<script>
function getTimeRemaining(endtime) {
  var t = Date.parse(endtime) - Date.parse(new Date());
  var seconds = Math.floor((t / 1000) % 60);
  var minutes = Math.floor((t / 1000 / 60) % 60);
  var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
  var days = Math.floor(t / (1000 * 60 * 60 * 24));
  return {
    'total': t,
    'days': days,
    'hours': hours,
    'minutes': minutes,
    'seconds': seconds
  };
}

function initializeClock(id, endtime) {
  var clock = document.getElementById(id);
  var daysSpan = clock.querySelector('.days');
  var hoursSpan = clock.querySelector('.hours');
  var minutesSpan = clock.querySelector('.minutes');

  function updateClock() {
    var t = getTimeRemaining(endtime);

    daysSpan.innerHTML = t.days;
    hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
    minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);

    if (t.total <= 0) {
      clearInterval(timeinterval);
    }
    //console.log(Date.parse(new Date()) + 15 * 24 * 60 * 60 * 1000);
  }

  updateClock();
  var timeinterval = setInterval(updateClock, 1000);
}

var deadline = new Date(Date.parse('{!! \Carbon\Carbon::parse($event->quote->eventDate)->format("Y/m/d") !!}'));
initializeClock('clockdiv', deadline);
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
      $('.card-header').click(function(){
          var obj=$(this).parent();
          $('.card-body', obj).slideToggle();
      })
  </script>

@endsection

