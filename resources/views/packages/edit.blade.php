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
                    <h3 class="panel-title">Editar Paquete {{$package->name}} </h3>
                      <form method="POST" action="{{ route('packages.update',$package->id) }}"  class="newPackageForm"  role="form">
                      {{ csrf_field() }}
                      <input name="_method" type="hidden" value="PATCH">
                        <div class="form-row form-group">
                          <div class="col-xs col-md-6 mb1r">
                            <label for="name">Nombre del paquete</label>
                            <input type="text" name="name" id="name" class="form-control input-sm" value="{{$package->name}}">
                        </div>
                          <div class="col-xs-6 col-md-6">
                            <label for="minQty">Cantidad minima de personas</label>
                            <input type="number" name="minQty" id="minQty" class="form-control input-sm" placeholder="Cantidad minima de personas" value="{{$package->minQty}}">
                          </div>
                        </div>
                        <div class="form-group form-row">
                          <div class="col">
                            <label for="kidsPrice">Precio por niño</label>
                            <input type="number" name="kidsPrice" id="kidsPrice" class="form-control input-sm" placeholder="Precio por niño" value="{{$package->kidsPrice}}">
                          </div>
                          <div class="col">
                            <label for="adultPrice">Precio por adulto</label>
                            <input type="number" name="adultPrice" id="adultPrice" class="form-control input-sm" placeholder="Precio por adulto" value="{{$package->adultPrice}}">
                          </div>
                      </div>
                      <div class="servicesSelection form-group">
                          <h4>Servicios incluidos</h4>
                          @foreach ($allServices as $u_service)
                          <div class="form-check">
                            @if ($u_service->packages->contains($package->id))
                              <input type="checkbox" class="form-check-input" id="service{{$u_service->id}}" checked="checked" name="services[]" value="{{$u_service->id}}">
                              <label class="form-check-label" for="service{{$u_service->id}}">{{$u_service->name}}</label>
                            @else
                              <input type="checkbox" class="form-check-input" id="service{{$u_service->id}}"name="services[]" value="{{$u_service->id}}">
                              <label class="form-check-label" for="service{{$u_service->id}}">{{$u_service->name}}</label>
                              @endif
                          </div>
                        @endforeach
                      </div>
                      <div class="form-group form-row">
                        <div class="col-md-3 offset-md-9">
                          <input type="submit"  value="Guardar" class="btn btn-success btn-block createClient">
                        </div>
                      </div>
                     </form>
                    </div>
@endsection



