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
    <h3 class="panel-title">Editar Cliente</h3>
    <form role="form" method="POST" action="{{ route('clients.update',$client->id) }}"  class="newClientForm">
        <input type="hidden" name="_method" value="PUT">
        {{ csrf_field() }}
        <div class="form-row form-group">
            <div class="col-xs col-md-6">
                <label for="name">Nombre <span class="reqStar">*</span></label>
                <input type="text" name="name" id="name" class="form-control input-sm" placeholder="Nombre" required value="{{$client->name}}">
            </div>
            <div class="col-xs col-md-6">
                <label for="lastname">Apellido <span class="reqStar">*</span></label>
                <input type="text" name="lastname" id="lastname" class="form-control input-sm" placeholder="Apellido" required value="{{$client->lastname}}">
            </div>
        </div>
        <div class="form-row form-group">
            <div class="col-md-4 col-xs mb1r">
                <label for="email">Email <span class="reqStar">*</span></label>
                <input type="text" name="email" id="email" class="form-control input-sm" placeholder="Correo Electronico" required value="{{$client->email}}">
            </div>
            <div class="col-md-4 col-xs mb1r">
                <label for="dniType">Tipo de documento <span class="reqStar">*</span></label>
                <select name="dniType" id="dniType" class="form-control input-sm" required value="{{$client->dniType}}">
                    <option value="">Seleccione un tipo de documento</option>
                    <option value="IFE" {{$client->dniType  == 'IFE' ? 'selected' : ''}}>IFE</option>
                    <option value="FMM" {{$client->dniType  == 'FMM' ? 'selected' : ''}}>FMM</option>
                    <option value="Pasaporte" {{$client->dniType  == 'Pasaporte' ? 'selected' : ''}}>Pasaporte</option>
                </select>
            </div>
            <div class="col-md-4 col-xs">
                <label for="dni">Numero de documento <span class="reqStar">*</span></label>
                <input type="text" name="dni" id="dni" class="form-control input-sm" placeholder="Numero de documento" required value="{{$client->dni}}">
            </div>
        </div>
        <div class="form-row form-group">
            <div class="col-md-4 col-xs mb1r">
                <label for="fiscalname">Nombre Fiscal</label>
                <input type="text" name="fiscalname" id="fiscalname" class="form-control input-sm" placeholder="Nombre Fiscal" value="{{$client->fiscalname}}">
            </div>
            <div class="col-md-4 col-xs mb1r">
                <label for="commercialname">Nombre Comercial</label>
                <input type="text" name="commercialname" id="commercialname" class="form-control input-sm" placeholder="Nombre Comercial" value="{{$client->commercialname}}">
            </div>
            <div class="col-md-4 col-xs">
                <label for="rfc">RFC <span class="reqStar">*</span></label>
                <input type="text" name="rfc" id="rfc" class="form-control input-sm" placeholder="RFC" required value="{{$client->rfc}}">
            </div>
        </div>
        <div class="form-row form-group">
            <div class="col-md-6">
                <label for="phone">Telefono <span class="reqStar">*</span></label>
                <input type="text" name="phone" id="phone" class="form-control input-sm" placeholder="Telefono" required value="{{$client->phone}}">
            </div>
        </div>
        <div class="form-row text-center">
            <h4 class="text-center">Datos de dirección</h4>
        </div>
        <div class="form-row form-group">
            <div class="col">
                <label>Búsqueda por ciudad o estado</label>
                <input id="autocomplete_search" name="autocomplete_search" type="text" class="form-control" placeholder="Search" />
            </div>
        </div>
        <div class="form-row form-group">
            <div class="col">
                <label for="city">Ciudad <span class="reqStar">*</span></label>
                <input type="text" name="city" id="city" readonly class="form-control input-sm" placeholder="Ciudad" required value="{{$client->city}}">
            </div>
            <div class="col">
                <label for="state">Estado <span class="reqStar">*</span></label>
                <input type="text" name="state" id="state" readonly class="form-control input-sm" placeholder="Estado" required value="{{$client->state}}">
            </div>
        </div>
        <div class="form-row form-group">
            <div class="col">
                <label for="number">Numero de casa <span class="reqStar">*</span></label>
                <input type="text" name="number" id="number" class="form-control input-sm" placeholder="Numero de casa/Departamento" required value="{{$client->number}}">
            </div>
            <div class="col">
                <label for="street">Calle <span class="reqStar">*</span></label>
                <input type="text" name="street" id="street" class="form-control input-sm" placeholder="Calle" required value="{{$client->street}}">
            </div>
        </div>
        <div class="form-row form-group">
            <div class="col">
                <label for="colony">Colonia <span class="reqStar">*</span></label>
                <input type="text" name="colony" id="colony" class="form-control input-sm" placeholder="Colonia" required value="{{$client->colony}}">
            </div>
            <div class="col">
                <label for="postalCode">Código postal <span class="reqStar">*</span></label>
                <input type="number" name="postalCode" id="postalCode" class="form-control input-sm" placeholder="Codigo Postal" required value="{{$client->postalCode}}">
            </div>
        </div>
        <div class="form-group form-row">
            <div class="col-md-6 col-xs mb1r">
                <a href="{{url('/')}}/clients" class="btn btn-info btn-block clientFormClose" >Volver</a>
            </div>
            <div class="col-md-6 col-xs">
                <input type="submit"  value="Guardar" class="btn btn-success btn-block createClient">
            </div>
        </div>
    </form>
</div>

<script>
function initialize() {
    var options = {
    language:'es',
    types: ['(cities)'],
    componentRestrictions: {
        country: "mx"
    }
    };

    var input = document.getElementById('autocomplete_search');
    var autocomplete = new google.maps.places.Autocomplete(input, options);
    autocomplete.addListener('place_changed', function () {
    var place = autocomplete.getPlace();
    // place variable will have all the information you are looking for.
    $('#lat').val(place.geometry['location'].lat());
    $('#long').val(place.geometry['location'].lng());
    console.log(place.address_components[0].long_name);
    console.log(place.address_components[1].long_name);
    $('#city').val(place.address_components[0].long_name)
    $('#state').val(place.address_components[1].long_name)
});
}

google.maps.event.addDomListener(window, 'load', initialize);
</script>

<script>
$(".newClientForm").validate({
    lang:'es'
});
</script>

@endsection




