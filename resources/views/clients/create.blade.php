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

					<h3 class="panel-title">Nuevo cliente</h3>
						<form method="POST" action="{{ route('clients.store') }}"  role="form">
							{{ csrf_field() }}
										<input type="text" name="name" id="name" class="form-control input-sm" placeholder="Nombre">
										<input type="text" name="lastname" id="lastname" class="form-control input-sm" placeholder="Apellido">
										<input type="text" name="email" id="email" class="form-control input-sm" placeholder="Correo Electronico">
                                        <input type="text" name="rfc" id="rfc" class="form-control input-sm" placeholder="RFC">
										<input type="text" name="fiscalname" id="fiscalname" class="form-control input-sm" placeholder="Nombre Fiscal">
                                        <input type="text" name="commercialname" id="commercialname" class="form-control input-sm" placeholder="Nombre Comercial">
                                        <input type="text" name="phone" id="phone" class="form-control input-sm" placeholder="Telefono">
									<input type="submit"  value="Guardar" class="btn btn-success btn-block">
                                    <a href="{{ route('clients.index') }}" class="btn btn-info btn-block" >Atrás</a>
						</form>
@endsection
