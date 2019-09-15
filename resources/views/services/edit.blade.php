@extends('layouts.sidebar')

@section('pageTitle', 'Editar Servicio')

@section('content')
<div class="defaultForm">
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

  <h3 class="panel-title">Editar Servicio</h3>
<form method="POST" action="{{ route('services.update',$service->id) }}"  role="form">
{{ csrf_field() }}
<input name="_method" type="hidden" value="PATCH">
  <div class="form-row form-group">
    <div class="col">
      <label for="name">Nombre del servicio</label>
      <input type="text" name="name" id="name" class="form-control input-sm" value="{{$service->name}}">
    </div>
  </div>
  <div class="form-row form-group">
    <div class="col-xs col-md-6 mb1r">
      <label for="category_id">Categoría</label>
      <select name="category_id" id="category_id" class="form-control input-sm" required>
        <option value="">Seleccione una Categoría</option>
        @foreach ($services_categories as $service_category)
        <option value="{{$service_category->id}}" {{ ($service_category->id == $service->category_id) ? 'selected' : '' }}>{{$service_category->name}}</option>
        @endforeach
      </select>
    </div>
    <div class="col">
      <label for="servicePrice">Precio</label>
      <input type="text" name="servicePrice" id="servicePrice" class="form-control input-sm" value="{{$service->servicePrice}}">
    </div>
    <div class="col align-self-end">
      <input type="submit"  value="Guardar" class="btn btn-success btn-block createClient">
    </div>
  </div>
</form>
</div>

@endsection
