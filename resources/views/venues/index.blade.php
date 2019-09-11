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
   <h3 class="panel-title">Nueva Ubicacion</h3>
   <form method="POST" class="newVenueForm"  role="form">
   {{ csrf_field() }}
   <div class="form-row form-group">
     <div class="col">
       <label for="name">Nombre</label>
       <input type="text" name="name" id="name" class="form-control input-sm" placeholder="Nombre" required>
     </div>
     <div class="col">
       <label for="location">Ubicación</label>
       <input type="text" name="location" id="pac-input" class="controls form-control input-sm" placeholder="Ubicación" required>
     </div>
   </div>
   <div class="form-row form-group">
     <div class="col">
       <label for="mincapacity">Mínimo de personas recomendado</label>
       <input type="number" name="mincapacity" id="maxcapacity" class="form-control input-sm" placeholder="Capacidad Minima" required>
      </div>
      <div class="col">
        <label for="maxcapacity">Capacidad máxima</label>
        <input type="number" name="maxcapacity" id="maxcapacity" class="form-control input-sm" placeholder="Capacidad Maxima" required>
      </div>
      <div class="col align-self-end">
        <input type="submit"  value="Guardar" class="btn btn-success btn-block createClient">
      </div>
    </div>
  </form>
</div>
<div class="alert alert-success success-message" role="alert"></div>

<table class="stripe infotable" id="venuesTable">
  <thead>
      <tr>
          <th>Nombre</th>
          <th>Direccion</th>
          <th>Minimo de personas recomendado</th>
          <th>Capacidad Maxima</th>
      </tr>
  </thead>
  <tbody>
      @foreach ($venues as $venue)
      <tr>
      <td>{{$venue->name}} <a href="{{url('/')}}/venues/{{$venue->id}}">Ver calendario</a></td>
          <td>{{$venue->location}}</td>
          <td>{{$venue->mincapacity}}</td>
          <td>{{$venue->maxcapacity}}</td>
      </tr>
      @endforeach
  </tbody>
</table>

<script>
  $(document).ready( function () {
    var table=$('#venuesTable').DataTable();

  $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$('.newVenueForm').submit(function(event) {
event.preventDefault();
var formData = {
    'name': $('input[name=name]').val(),
    'location': $('input[name=location]').val(),
    'mincapacity': $('input[name=mincapacity]').val(),
    'maxcapacity': $('input[name=maxcapacity]').val(),
    };
// process the form
$.ajax({
    type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
    url         : '{{url('/')}}/api/venues', // the url where we want to POST
    data        : formData // our data object
}).done(function(data) {
        $('.newVenueForm').trigger("reset");
        $('.success-message').slideToggle();
        $('.success-message').html(data.msg);
        console.log(data);
        window.location.reload();
        // here we will handle errors and validation messages
    });
});
  });

$(".newVenueForm").validate({
    lang:'es'
});
</script>



@endsection
