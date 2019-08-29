@extends('layouts.sidebar')

@section('pageTitle', 'Clientes')

@section('content')
@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Error!</strong> Revise los campos obligatorios.<br><br>
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
@if(Session::has('success'))
  <div class="alert alert-info">
    {{Session::get('success')}}
  </div>
@endif
<div class="defaultForm">
  <h3 class="panel-title">Nuevo Paquete</h3>
    <form method="POST" action="{{ route('packages.store') }}"  role="form">
    {{ csrf_field() }}
    <div class="form-row form-group">
      <div class="col">
        <label for="name">Nombre del paquete</label>
        <input type="text" name="name" id="name" class="form-control input-sm" placeholder="Nombre">
      </div>
      <div class="col">
            <label for="minQty">Cantidad minima de personas</label>
            <input type="number" name="minQty" id="minQty" class="form-control input-sm" placeholder="Cantidad minima de personas">
      </div>
    </div>
    <div class="form-group form-row">
      <div class="col">
        <label for="kidsPrice">Precio por niño</label>
        <input type="number" name="kidsPrice" id="kidsPrice" class="form-control input-sm" placeholder="Precio por niño">
      </div>
      <div class="col">
        <label for="adultPrice">Precio por adulto</label>
        <input type="number" name="adultPrice" id="adultPrice" class="form-control input-sm" placeholder="Precio por adulto">
      </div>

    </div>
    <div class="servicesSelection form-group">
      @foreach ($allServices as $service)
      <div class="form-check">
        <input type="checkbox" class="form-check-input" id="service{{$service->id}}" name="services[]" value="{{$service->id}}">
        <label class="form-check-label" for="service{{$service->id}}">{{$service->name}}</label>
      </div>
      @endforeach
    </div>
    <div class="form-group form-row">
      <input type="submit"  value="Guardar" class="btn btn-success btn-block">
      <a href="{{ route('packages.index') }}" class="btn btn-info btn-block" >Atrás</a>
    </div>
  </form>
</div>

@endsection
