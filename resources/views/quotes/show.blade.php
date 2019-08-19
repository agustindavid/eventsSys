@extends('layouts.sidebar')

@section('pageTitle', 'quotees')

@section('content')

<p>Cliente: {{$quote->client->name}} {{$quote->client->lastname}}</p>
<p>Nombre del evento: {{$quote->eventName}}</p>
<p>Fecha del evento: {{$quote->eventDate}}</p>
<p>Hora del evento:{{$quote->eventTime}}</p>
<p>Fecha final:{{$quote->eventFinishDate}}</p>
<p>Hora Final{{$quote->eventFinishTime}}</p>
<p>Precio: {{$quote->price}}</p>
<p>Estado: {{$quote->status}}</p>
<p>Cantidad de personas: {{$quote->peopleQty}}</p>
<p>Valido hasta: {{$quote->validThru}}</p>
<p>Locacion: {{$quote->venue->name}}</p>
<p>Paquete: {{$quote->package->name}}</p>
<p>Servicios:</p>
<ul>
@foreach ($quote->package->services as $service)
<li>{{$service->name}}</li>
@endforeach
</ul>


@endsection
