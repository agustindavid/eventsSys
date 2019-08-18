@extends('layouts.sidebar')

@section('pageTitle', 'packagees')

@section('content')


<h2>{{$package->name}}</h2>

<h3>Servicios</h3>

@foreach ($allServices as $u_service)
  @if ($u_service->packages->contains($package->id))
    <input type="checkbox" name="vehicle" checked="checked" value="Bike">{{$u_service->name}}<br>
  @else
  <input type="checkbox" name="vehicle" value="Bike">{{$u_service->name}}<br>
  @endif
@endforeach

@endsection
