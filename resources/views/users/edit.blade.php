@extends('layouts.sidebar')

@section('pageTitle', 'Editar Usuario')

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
<h3 class="panel-title">Asignar Permisos para {{$user->name}} ({{$user->email}})</h3>
  <form method="POST" action="{{ route('users.update',$user->id) }}"  role="form">
  {{ csrf_field() }}
  <input name="_method" type="hidden" value="PATCH">
  <div class="form-group row">

        <div class="col">
                <label for="name" class="">Nombre</label>

            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">

            <div class="col">
                    <label for="password" class="">Contrasena</label>

                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">

            <div class="col">
                    <label for="password-confirm" class="">Confirmacion de contrasena</label>

                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
        </div>
    @foreach ($allPermissions as $permission)
    @if ($user->hasPermissionTo($permission->name))
    <input type="checkbox" name="permissions[]" checked="checked" value="{{$permission->name}}">{{$permission->name}}<br>
    @else
    <input type="checkbox" name="permissions[]" value="{{$permission->name}}">{{$permission->name}}<br>
    @endif
@endforeach
    <input type="submit"  value="Actualizar" class="btn btn-success btn-block">
	<a href="{{ route('users.index') }}" class="btn btn-info btn-block" >Atrás</a>
						</form>

@endsection
