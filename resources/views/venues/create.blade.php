@extends('layouts.sidebar')

@section('pageTitle', 'services')

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


                    <h3 class="panel-title">Nueva Ubicacion</h3>

                        <form method="POST" action="{{ route('venues.store') }}"  role="form">
                            {{ csrf_field() }}
                                  <input type="text" name="name" id="name" class="form-control input-sm" placeholder="Nombre">
                                        <input type="text" name="location" id="pac-input" class="controls form-control input-sm" placeholder="Ubicacion">
                                        <input type="number" name="mincapacity" id="maxcapacity" class="form-control input-sm" placeholder="Capacidad Minima">
                                        <input type="number" name="maxcapacity" id="maxcapacity" class="form-control input-sm" placeholder="Capacidad Maxima">
                                    <input type="submit"  value="Guardar" class="btn btn-success btn-block">
                                    <a href="{{ route('venues.index') }}" class="btn btn-info btn-block" >Atrás</a>
                        </form>

                        <script>
                            var defaultBounds = new google.maps.LatLngBounds(
  new google.maps.LatLng(21.955454, -101.200713),
  new google.maps.LatLng(22.335762, -100.792730));

var input = document.getElementById('pac-input');
var options = {
  //types: ['establishment']
};

autocomplete = new google.maps.places.Autocomplete(input, options);
                        </script>
        @endsection
