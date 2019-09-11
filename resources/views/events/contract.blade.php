<style>
    .text-uppercase {
        text-transform: uppercase;
    }
    .text-capitalize {
        text-transform: capitalize;
    }
    p.text-center.subtitle {
        text-align: center;
        font-size: 22px;
    }
    .page-break {
        page-break-after: always;
    }

    .wrapper{
        font-family:'verdana', sans-serif;
        font-weight:100;
        font-size:12px;
    }

    h2 {
    font-size: 13px;
    font-weight: 100;
}
.logo{
    width: 100px;
    height: auto;
    margin-right: 30px;
}
</style>

<div class="wrapper">
<div><h2 class="text-uppercase"><img class="logo" src="{{url('/')}}/img/logo.jpg">contrato de prestaciones de servicios de eventos especiales el francés</h2></div>

<div class="text-uppercase"><p>Que celebran por una parte el salón de eventos especiales “el francés” a quien en lo sucesivo se le denominará “el prestador del servicio”, por otra parte <i><b>{{$event->quote->client->name}} {{$event->quote->client->lastname}}</b></i> a quien en lo sucesivo se le denominará “el consumidor”, para efectos del presente contrato, al tenor de las siguientes declaraciones y cláusulas:</p></div>

<div><p>DECLARA <strong>“EL PRESTADOR DEL SERVICIO”:</strong></p></div>

<div><p> A) Que SALÓN DE EVENTOS ESPECIALES “EL FRANCÉS” es el nombre comercial que es utilizado por una persona física con actividad empresarial, que se dedica a la prestación del servicio de renta de mobiliario y enseres para fiestas, entre otros giros más.</p></div>

<div><p>B) Que se encuentra inscrita en el Registro Federal de Contribuyentes bajo el número CAGR550131LQ9.</p></div>

<div><p>C) Que cuenta con la capacidad, infraestructura, servicios y recursos necesarios para dar cabal cumplimiento a las obligaciones que por virtud del presente contrato adquiere.</p></div>

<div><p>D) Que para efectos legales el presente contrato señala como su domicilio en la Avenida Muñoz #360, fraccionamiento Hacienda de Bravo en la ciudad de San Luis Potosí, S.L.P.</p></div>

<div><p>2.- Declara <strong>“EL CONSUMIDOR”</strong>:</p></div>

<div><p>A) Llamarse como ha quedado en el proemio de este contrato.</p></div>

<div><p>B) Que es su deseo obligarse en los términos y condiciones del presente contrato manifestó que cuenta con la capacidad legal para la celebración de este acto.</p></div>

<div><p>C) Que su número telefónico es el <i><b>{{$event->quote->client->phone}}</b></i> y celular es el <i><b>{{$event->quote->client->phone}}</b></i> </p></div>

<div><p>D) Que para efectos legales del presente contrato, señala como su domicilio ubicado en la casa con número <i><b>{{$event->quote->client->number}}</b></i> de la calle <i><b>{{$event->quote->client->street}}</b></i> de la Colonia <i><b>{{$event->quote->client->colony}}</b></i> en la Ciudad de <i><b>{{$event->quote->client->city}}</b></i>.</p></div>

<div><p class="text-center subtitle"><strong>CLÁUSULAS</strong></p></div>

<div><p><strong>PRIMERA. –</strong> El objeto del presente contrato es que “EL CONSUMIDOR” contrata a “EL PRESTADOR DEL SERVICIO” para la organización de un evento social para <i><b>{{$event->quote->peopleQty}}</b></i> personas, el cual se llevará a cabo el día <i><b>{!! \Carbon\Carbon::parse($event->quote->eventDate)->format('d') !!}</b></i> del mes <i><b>{!! \Carbon\Carbon::parse($event->quote->eventDate)->formatLocalized('%B') !!}</b></i> del <i><b>{!! \Carbon\Carbon::parse($event->quote->eventDate)->format('Y') !!}</i></b>, y tendrá una duración de <i><b>{{$event->duration}}</b></i> horas, de acuerdo a las características y especificaciones de este contrato.</p></div>

<div><p><strong>SEGUNDA. –</strong> El evento social estará verificado en el lugar marcado con el número 360 de la Avenida Muñoz, fraccionamiento Hacienda de Bravo, San Luis Potosí, S.L.P.</p></div>

<div><p><strong>TERCERA. –</strong> El costo total que <strong>“EL CONSUMIDOR”</strong> debe de solventar por prestación del servicio será de $ <i><b>{{$event->quote->price}}</b></i>, cantidad que será cubierta en moneda nacional, y es calculado de acuerdo a los siguientes criterios:</p></div>

<div class="w_80">

<p>A) Tipo de Evento:<strong>{{$event->quote->categories->name}}</strong></p>
<p>B) Paquete Contratado: <strong>{{$event->quote->package->name}}</strong></p>
<p>C) Salón:<strong> {{$event->quote->venue->name}}</strong> </p>
<p>D) Costo por persona adulta: <strong>${{$event->quote->package->adultPrice}}</strong></p>
<p>E) Costo por joven o niño:<strong> ${{$event->quote->package->kidsPrice}} </strong> (Niños de 2 años en adelante son considerados como invitados, por lo que entran con pase)</p>
</div>

<div><p><strong>CUARTA. –</strong> Los pagos se realizarán de acuerdo a criterio de <strong>“EL CONSUMIDOR”, comprometiéndose a liquidar la cantidad total una (01) semana antes de la fecha acordada del evento.</strong></p></div>

<div><p><strong>QUINTA. –</strong> Al momento de la firma del presente contrato, <strong>“EL CONSUMIDOR”</strong> ENTREGA LA CANTIDAD DE <b>${{$event->payments[0]->amount}}</b> por <strong>CONCEPTO DE ANTICIPO</strong>, mismo que corresponde al recibo N°0<i><b>{{$event->payments[0]->id}}</b></i>.</p></div>

<div><p><strong>SEXTA. –</strong> En este acto, <strong>“EL CONSUMIDOR”</strong> entrega <strong>UN DEPÓSITO</strong> por la cantidad de <i><b>${{$event->deposit}}</b></i> como garantía por la renta de los bienes muebles e inmuebles que serán objeto de la renta, depósito que será reembolsable a partir del día hábil siguiente a la realización del evento, siempre y cuando no exista pérdida material o excedente por operación, conforme a las cláusulas NOVENA y DÉCIMA.</p></div>

<div><p><strong>SÉPTIMA. – “EL PRESTADOR DEL SERVICIO”</strong> expedirá comprobante de todo pago que sea efectuado por <strong>“EL CONSUMIDOR”</strong> en el que contendrá por lo menos la siguiente información: nombre, razón social, fecha e importe del anticipo nombre y firma de las personas debidamente autorizadas que recibe el anticipo y el sello del establecimiento, el nombre del consumidor, la fecha y tipo de evento.</p></div>


<div><p><strong>OCTAVA. –</strong> A efecto de tener seguridad en cuanto al número de asistentes, así como para garantizar que sólo ingresen las personas autorizadas por “EL CONSUMIDOR” al evento social, AMBAS PARTES establecen como procedimiento y verificación de control, el uso de <u>pases personales</u>, mismos que deberán ser presentados por <strong>“EL CONSUMIDOR”</strong> con su debida anticipación, para que sean sellados por <strong>“EL PRESTADOR DEL SERVICIO”</strong></p></div>

<div><p><strong>NOVENA. –“EL CONSUMIDOR”</strong> se responsabiliza del excedente de personas que con su autorización hayan ingresado al evento, el pago por persona extra una vez iniciado su evento será de <i><b>${{$event->extraPerson}}</b></i> por persona (Niño o adulto). <strong>“EL PRESTADOR DEL SERVICIO”</strong> únicamente contará con una capacidad máxima de atender a 12 personas extra.</p></div>

<div><p><strong>DÉCIMA. –</strong> Si los bienes destinados a la prestación del servicio sufren menoscabo o negligencia debidamente comprobada por parte de <strong>“EL CONSUMIDOR”</strong> o de sus invitados, éste se obliga a cubrir los gastos de la reparación de los mismo, o en otro caso indemnizará a <strong>“EL PRESTADOR DEL SERVICIO”</strong> hasta un 90% del valor del objeto, calculado como nuevo a la fecha que se realizó el daño.</p></div>

<div><p><strong>DÉCIMA PRIMERA. -</strong>  AMBAS PARTES están conformes en que “EL CONSUMIDOR” podrá contratar libremente servicios específicos relacionados con el evento social, con otros prestadores de servicios por así convenir a sus intereses, por lo que en caso de actualizarse dicho supuesto, “EL CONSUMIDOR” libera de toda responsabilidad a “EL PRESTADOR DEL SERVICIO” en lo que respecta a dichos servicios en particular.</p></div>

<div><p><strong>DÉCIMA SEGUNDA. -</strong>  En caso de que <strong>“EL PRESTADOR DEL SERVICIO”</strong> se encuentre imposibilitado a realizar el servicio por caso fortuito o fuerza mayor, como incendio, temblor, u otros acontecimientos de la naturaleza o hechos del hombre ajenos a la voluntad de <strong>“EL PRESTADOR DEL SERVICIO”</strong>, o por órdenes judiciales o administrativas, <strong>“EL PRESTADOR DEL SERVICIO”</strong> queda totalmente libre de responsabilidades, con lo cual no lo obliga a reintegrar los anticipos realizados a <strong>“EL CONSUMIDOR”</strong>. Para dicha circunstancia se podrá acordar reemplazar la fecha por ambas partes, siempre y cuando los proveedores de <strong>“EL PRESTADOR DEL SERVICIO”</strong> accedan a dicho cambio, ya que, por efectos naturales de cada uno, no los obliga a este acuerdo.</p></div>

<div><p>Esta cláusula no aplica si las causas de incumplimiento son por cuestiones atribuibles a <strong>“EL PRESTADOR DEL SERVICIO”</strong>, tales como: enfermedad, problemas físicos, personales, accidentales, mala planeación en tiempos, etc., por lo tanto, <strong>“EL PRESTADOR DEL SERVICIO”</strong> se le obliga a cumplir con el contrato según lo pactado, o en su defecto reembolsar el dinero correspondiente a cada insumo incumplido por el mismo a <strong>“EL CONSUMIDOR”</strong> al siguiente día hábil en el caso de n haber cumplido con el contrato en tiempo y forma.</p></div>

<div><p><strong>DÉCIMA TERCERA. –</strong> Si <strong>“EL CONSUMIDOR”</strong> cancela el presente contrato una vez firmado el mismo, <strong>“EL PRESTADOR DEL SERVICIO”</strong> quedará exento de reembolsar el anticipo o los pagos antes recibidos, bajo ningún motivo, ello derivado de que <strong>“EL PRESTADOR DEL SERVICIO”</strong> subcontrata diversos servicios que serán ofrecidos en el evento, implicando pagos a terceras personas, por lo que resulta imposible su devolución.</p></div>

<div><p><strong>DÉCIMA CUARTA. - “EL CONSUMIDOR”</strong> se compromete a <strong>LIQUIDAR</strong> la totalidad de la cotización pactada cuando menos 7 días antes de la fecha del evento, por lo tanto, si existe incumplimiento por parte de <strong>“EL CONSUMIDOR”</strong>, el <strong>“EL PRESTADOR DEL SERVICIO”</strong> automáticamente quedará liberado de la obligación de realizar el evento, sin reintegro o reembolso de efectivo alguno.</p></div>

<div><p><strong>DÉCIMA QUINTA. – </strong>Para el caso de que <strong>“EL CONSUMIDOR”</strong> cancele dentro de seis (06) meses previos a la realización del evento, éste se obliga a pagar la totalidad del evento más los intereses generados por día que transcurra de incumplimiento; los intereses generados son calculados a una tasa de 3% mensual sobre el valor total del adeudo.</p></div>

<div><p><strong>DÉCIMA SEXTA. -“EL CONSUMIDOR”</strong> desde este momento libera a <strong>“EL PRESTADOR DEL SERVICIO”</strong> de cualquier acto realizado por terceras personas que alteren el orden del evento, llámese: vandalismo, terrorismo, peleas, etc. Del mismo modo, libera a <strong>“EL PRESTADOR DEL SERVICIO”</strong> por homicidios, muertes naturales, muertes accidentales, etc., que ocurrieran dentro de sus instalaciones o al momento de desarrollarse el evento, que sean ajenos a su voluntad.</p></div>

<div><p><strong>DÉCIMA SÉPTIMA. – </strong>Para la interpretación y cumplimiento del presente contrato, las partes se someten a la competencia de la Procuraduría Federal del Consumidor y a las Leyes de Jurisdicción de los tribunales competentes a la Ciudad de San Luis Potosí.</p></div>

<div><p>Leído que fue el presente documento y enteradas las partes de su alcance y contenido legal, manifestando que no existe error, dolo, violencia o lesión alguna, lo suscriben en la Ciudad de San Luis Potosí, S.L.P.</p></div>

<div><p>A los {!! \Carbon\Carbon::parse($event->payments[0]->payDate)->format('d') !!} días del mes de {!! \Carbon\Carbon::parse($event->payments[0]->payDate)->formatLocalized('%B') !!} del año <span class="text-capitalize">{!! \Carbon\Carbon::parse($event->payments[0]->payDate)->format('Y') !!}</span></p></div>

<table style="width:100%; margin:100px 0;;" cellspacing="40">
    <tr>
        <td style="text-align:center; border-top:1px solid; padding-bottom:70px; width:40%; margin-right:15px">
            <p>“EL PRESTADOR DEL SERVICIO”</p>
        </td>
        <td style="text-align:center; border-top:1px solid; padding-bottom:70px; width:40%;  margin-left:15px;">
            <p>“EL CONSUMIDOR”</p>
        </td>
    </tr>
    <tr>
        <td style="text-align:center; border-top:1px solid;">
            <p>EJECUTIVO DE VENTA</p>
        </td>
        <td style="text-align:center; border-top:1px solid;">
            <p>TESTIGO</p>
        </td>
    </tr>
</table>



