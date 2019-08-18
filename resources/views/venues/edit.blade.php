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

                <h3 class="panel-title">Editar Servicio</h3>
						<form method="POST" action="{{ route('venues.update',$venue->id) }}"  role="form">
							{{ csrf_field() }}
							<input name="_method" type="hidden" value="PATCH">
										<input type="text" name="name" id="name" class="form-control input-sm" value="{{$venue->name}}">
										<input type="text" name="location" id="location" class="form-control input-sm" value="{{$venue->location}}">
										<input type="text" name="location" id="location" class="form-control input-sm" value="{{$venue->location}}">
                                        <input type="number" name="mincapacity" id="mincapacity" class="form-control input-sm" value="{{$venue->mincapacity}}">
                                        <input type="number" name="maxcapacity" id="maxcapacity" class="form-control input-sm" value="{{$venue->maxcapacity}}">

									<input type="submit"  value="Actualizar" class="btn btn-success btn-block">
									<a href="{{ route('venues.index') }}" class="btn btn-info btn-block" >Atrás</a>
						</form>
@endsection
