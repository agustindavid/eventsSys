@extends('layouts.sidebar')

@section('pageTitle', 'Salones')

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
   <h3 class="panel-title">Editar Ubicación</h3>
   <form method="POST" action="{{ route('venues.update',$venue->id) }}"  class="newVenueForm"  role="form">
   {{ csrf_field() }}
   <input name="_method" type="hidden" value="PATCH">
   <div class="form-row form-group">
     <div class="col">
       <label for="name">Nombre</label>
       <input type="text" name="name" id="name" class="form-control input-sm" placeholder="Nombre" required value="{{$venue->name}}">
     </div>
     <div class="col">
       <label for="location">Ubicación</label>
       <input type="text" name="location" id="pac-input" class="controls form-control input-sm" placeholder="Ubicación" required value="{{$venue->location}}">
     </div>
   </div>
   <div class="form-row form-group">
     <div class="col-md-4 col-xs mb1r">
       <label for="mincapacity">Mínimo de personas recomendado</label>
       <input type="number" name="mincapacity" id="maxcapacity" class="form-control input-sm" placeholder="Capacidad Minima" required value="{{$venue->mincapacity}}">
      </div>
      <div class="col-md-4 col-xs mb1r">
        <label for="maxcapacity">Capacidad máxima</label>
        <input type="number" name="maxcapacity" id="maxcapacity" class="form-control input-sm" placeholder="Capacidad Maxima" required value="{{$venue->maxcapacity}}">
      </div>
      <div class="col-md-4 align-self-end">
        <input type="submit"  value="Guardar" class="btn btn-success btn-block createClient">
      </div>
    </div>
  </form>
</div>
<div class="alert alert-success success-message" role="alert"></div>

<script>
$(".newVenueForm").validate({
    lang:'es'
});
</script>


@endsection
