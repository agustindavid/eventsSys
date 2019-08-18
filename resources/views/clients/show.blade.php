@extends('layouts.sidebar')

@section('pageTitle', 'Clientes')

@section('content')
<p>Nombre: {{$client->name}} {{$client->lastname}}</p>
<p>Email: {{$client->email}}</p>
<p>RFC: {{$client->rfc}}</p>
<p>Nombre fiscal: {{$client->fiscalname}}</p>
<p>Nombre comercial: {{$client->commercialname}}</p>
<p>Telefono: {{$client->phone}}</p>
@endsection
