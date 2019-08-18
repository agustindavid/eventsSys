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

	            <h3 class="panel-title">Editar Paquete</h3>
						<form method="POST" action="{{ route('packages.update',$package->id) }}"  role="form">
							{{ csrf_field() }}
							<input name="_method" type="hidden" value="PATCH">
										<input type="text" name="name" id="name" class="form-control input-sm" value="{{$package->name}}">
										<input type="text" name="price" id="price" class="form-control input-sm" value="{{$package->price}}">
	                                    @foreach ($allServices as $u_service)
                                            @if ($u_service->packages->contains($package->id))
                                              <input type="checkbox" name="services[]" checked="checked" value="{{$u_service->id}}">{{$u_service->name}}<br>
                                            @else
                                            <input type="checkbox" name="services[]" value="{{$u_service->id}}">{{$u_service->name}}<br>
                                            @endif
                                        @endforeach
    								<input type="submit"  value="Actualizar" class="btn btn-success btn-block">
									<a href="{{ route('packages.index') }}" class="btn btn-info btn-block" >Atrás</a>
						</form>

@endsection
