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

                <h3 class="panel-title">Editar Cliente</h3>
						<form method="POST" action="{{ route('clients.update',$client->id) }}"  role="form">
							{{ csrf_field() }}
							<input name="_method" type="hidden" value="PATCH">

										<input type="text" name="name" id="name" class="form-control input-sm" value="{{$client->name}}">
						            <input type="text" name="lastname" id="lastname" class="form-control input-sm" value="{{$client->lastname}}">
										<input type="text" name="email" id="email" class="form-control input-sm" value="{{$client->email}}">
						                <input type="text" name="rfc" id="rfc" class="form-control input-sm" value="{{$client->rfc}}">
                        				<input type="text" name="fiscalname" id="fiscalname" class="form-control input-sm" value="{{$client->fiscalname}}">
						                <input type="text" name="commercialname" id="commercialname" class="form-control input-sm" value="{{$client->commercialname}}">
                                        <input type="text" name="phone" id="phone" class="form-control input-sm" value="{{$client->phone}}">
                        			<input type="submit"  value="Actualizar" class="btn btn-success btn-block">
									<a href="{{ route('clients.index') }}" class="btn btn-info btn-block" >Atrás</a>
						</form>
                        @endsection
