@extends('layouts.sidebar')

@section('pageTitle', 'packagees')

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
						<form method="POST" action="{{ route('services.update',$service->id) }}"  role="form">
							{{ csrf_field() }}
							<input name="_method" type="hidden" value="PATCH">
										<input type="text" name="name" id="name" class="form-control input-sm" value="{{$service->name}}">
                                        <input type="text" name="servicePrice" id="servicePrice" class="form-control input-sm" value="{{$service->servicePrice}}">
                                        <select name="category_id" id="category_id">
                                            @foreach ($services_categories as $service_category)
                                                <option value="{{$service_category->id}}" {{ ($service_category->id == $service->category_id) ? 'selected' : '' }}>{{$service_category->name}}</option>
                                            @endforeach
                                        </select>
									<input type="submit"  value="Actualizar" class="btn btn-success btn-block">
									<a href="{{ route('services.index') }}" class="btn btn-info btn-block" >Atrás</a>
						</form>

	@endsection
