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

                    <h3 class="panel-title">Nuevo Paquete</h3>
                        <form method="POST" action="{{ route('packages.store') }}"  role="form">
                            {{ csrf_field() }}
                                        <input type="text" name="name" id="name" class="form-control input-sm" placeholder="Nombre">
                                        <input type="number" name="kidsPrice" id="kidsPrice" class="form-control input-sm" placeholder="Precio por niño">
                                        <input type="number" name="adultPrice" id="adultPrice" class="form-control input-sm" placeholder="Precio por adulto">
                                        @foreach ($allServices as $service)
                                            <input type="checkbox" name="services[]" value="{{$service->id}}">{{$service->name}}<br>
                                        @endforeach
                                    <input type="submit"  value="Guardar" class="btn btn-success btn-block">
                                    <a href="{{ route('packages.index') }}" class="btn btn-info btn-block" >Atrás</a>
                        </form>

@endsection
