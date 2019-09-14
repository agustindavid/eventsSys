@extends('layouts.sidebar')

@section('pageTitle', 'Categorías')

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
    <h3 class="panel-title">Editar Categoría</h3>
      <form method="POST" action="{{ route('categories.update',$category->id) }}"  class="newCategoryForm"  role="form">
      {{ csrf_field() }}
      <input type="hidden" name="_method" value="PUT">
      <div class="form-row form-group">
        <div class="col-xs col-md-4">
            <label for="name">Nombre de la categoría</label>
            <input type="text" name="name" id="name" class="form-control input-sm" placeholder="Nombre" required value="{{$category->name}}">
            <input type="hidden" name="slug" id="slug" value="{{$category->name}}">
        </div>
        <div class="col-xs col-md-4 mb1r">
          <label for="categorizable_type">Tipo de categoría</label>
          <select name="categorizable_type" id="categorizable_type" class="form-control input-sm" required value="{{$category->categorizable_type}}">
            <option value="">Seleccione el tipo de categoría</option>
            <option value="quotes" {{$category->categorizable_type=="quotes" ? "selected" : ""}} >Evento</option>
            <option value="services"  {{$category->categorizable_type=="services" ? "selected" : ""}} >Servicio</option>
          </select>
        </div>
        <div class="col-md-4 col-xs align-self-end">
            <input type="submit"  value="Guardar" class="btn btn-success btn-block createClient">
        </div>
      </div>
      </form>
</div>
<div class="alert alert-success success-message" role="alert"></div>


@endsection
