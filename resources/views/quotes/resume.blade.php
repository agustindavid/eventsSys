<style>
    table{
        width: 100%;
        margin: 15px 0;
    }
    p{
        margin: 0;
    }
    .wrapper{
        width: 95%;
        margin: auto;
        font-family:'verdana', sans-serif;
        font-weight:100;
        font-size:12px;
    }
    .w-70{
        width: 70%;
        text-align: left;
    }
    .w-10{
        width: 10%;
    }
    .w-30{
        width: 30%;
    }
    .w-60{
        width: 60%;
    }
    .w-80{
        width: 80%;
    }
    .w-20{
        width: 20%;
    }
    .w-50{
        width: 50%;
    }
    th {
        background-color: #eaeaea;
        padding: 5px;
    }

    .info {
        border:2px solid #aaa;
    }
    .info td{
        padding: 5px;
        border-bottom: 1px solid #ccc;
    }
    .page-break {
        page-break-after: always;
    }
</style>

<div class="wrapper">
<div class="header">
    <table>
            <tr>
                <td class="w-30">
                  <img class="logo" src="{{url('/')}}/img/logo.jpg" width="150px">
                </td>
                <td class="w-70" style="text-align:right">
                  <p>Eventos especiales El Francés</p>
                  <p>Av Muñoz No 360, Fracc, Los Laureles</p>
                  <p>Tel:8135055</p>
                </td>
            </tr>
    </table>
<hr>
    <table>
        <tr>
                <td class="w-50">
                    <p>Cotizacion a nombre de: <strong> {{$quote->client->name}} {{$quote->client->lastname}}</strong></p>
                    <p><strong>{{$quote->client->email}}</strong></p>
                    <p><small>{{$quote->client->number}}, {{$quote->client->street}}, {{$quote->client->colony}}</p>
                    <p><small>{{$quote->client->city}}, {{$quote->client->state}}</small></p>
                    <p>Vendedor: <strong>{{$quote->user->name}}</strong></p>

                </td>
                <td class="w-50" style="text-align:right">
                    <h3>Evento: {{$quote->eventName}}</h3>
                    <p>Fecha del evento: {!! \Carbon\Carbon::parse($quote->eventDate)->format('d-m-Y') !!} </p>
                    <p>Salon: <strong>{{$quote->venue->name}}</strong></p>
                    <p>Paquete: <strong>{{$quote->package->name}}</strong></p>
                    <p>Fecha de la Cotizacion: {!! \Carbon\Carbon::parse($quote->created_at)->format('d-m-Y') !!}</p>
                    <p>Valido hasta: {!! \Carbon\Carbon::parse($quote->validThru)->format('d-m-Y') !!}</p>
                </td>
        </tr>
    </table>
    <hr>
</div>
<div class="body">
    <table class="info">
        <thead>
          <tr>
            <th class="w-60" style="text-align:center">Item</th>
            <th class="w-20" style="text-align:center">Precio unitario</th>
            <th class="w-10" style="text-align:center">Cantidad</th>
            <th class="w-10" style="text-align:center">Precio</th>
          </tr>
        </thead>
        <tbody>
        <tr>
            <td>
              Precio por niño <small>({{$quote->package->name}})</small>
            </td>
            <td style="text-align:center">
              ${{$quote->package->kidsPrice}}
            </td>
            <td style="text-align:center">
              {{$quote->kidsQty}}
            </td>
            <td style="text-align:center">
              ${{$quote->package->kidsPrice * $quote->kidsQty}}
            </td>
        </tr>
        <tr>
            <td>
              Precio por adulto <small>({{$quote->package->name}})</small>
            </td>
            <td style="text-align:center">
              ${{$quote->package->adultPrice}}
            </td>
            <td style="text-align:center">
              {{$quote->adultsQty}}
            </td>
            <td style="text-align:center">
              ${{$quote->package->adultPrice * $quote->adultsQty}}
            </td>
        </tr>
        @if($quote->services->count()>0)
        <tr>
            <td colspan="4" style="text-align: center">
                    <b style="font-weight:bold">Servicios adicionales</b>
            </td>
        </tr>
        @foreach ($quote->services as $service)
        <tr>
            <td>
            {{$service->name}}
            </td>
            <td></td>
            <td></td>
            <td style="text-align:center">
                ${{$service->pivot->price}}
            </td>
        </tr>
        @endforeach
        @endif
        @if($quote->extrasPrice)
        <tr>
            <td>Extras</td>
            <td colspan="2"></td>
            <td>{{$quote->extrasPrice}}</td>
        </tr>
        @endif
        </tbody>
    </table>

    <table style="text-align:right">
            <tbody>
              <tr>
                <td class="w-60"></td>
                <td class="w-10"></td>
                <td class="w-20">
                  Subtotal del paquete:
                </td>
                <td class="w-10" style="text-align:center">
                  ${{$quote->package_price}}
                </td>
              </tr>
              @if($quote->discount > 0)
              <tr>
                  <td class="w-60"></td>
                  <td class="w-10"></td>
                  <td class="w-20" style="border-bottom: 1px solid #aaa; padding-bottom: 15px;">
                    Descuento:
                  </td>
                  <td class="w-10" style="text-align:center; border-bottom: 1px solid #aaa; padding-bottom: 15px;">
                    {{$quote->discount}}%
                  </td>
              </tr>
              @endif
              <tr>
                <td class="w-60"></td>
                <td class="w-10"></td>
                <td class="w-20" style="padding-top:15px;">
                    Total del paquete:
                </td>
                <td class="w-10" style="text-align:center; padding-top:15px">
                    ${{$quote->final_price}}
                </td>
              </tr>
              <tr>
                  <td class="w-60"></td>
                  <td class="w-10"></td>
                <td class="w-20">
                    Servicios adicionales:
                </td>
                <td class="w-10" style="text-align:center">
                    ${{$quote->extras_sum}}
                </td>
              </tr>
            </tbody>
        </table>
        <hr>
    <table class="total">
      <tr class="total">
          <td class="w-60"></td>
          <td class="w-10"></td>
          <td class="w-20" style="text-align:right">
            Precio Total
          </td>
          <td class="w-10" style="text-align:center">
            <strong>${{$quote->price}}</strong>
          </td>
      </tr>
    </table>
</div>

<div class="page-break"></div>
<h2>Servicios Incluidos</h2>
<ul>
    @foreach ($quote->package->services as $service)
        <li>{{$service->name}}</li>
    @endforeach
</ul>

</div>
