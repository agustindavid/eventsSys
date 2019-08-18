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


                    <h3 class="panel-title">Nueva Categoria</h3>
                        <form method="POST" action="{{ route('categories.store') }}"  role="form">
                            {{ csrf_field() }}
                                        <input type="text" name="name" id="name" class="form-control input-sm" placeholder="Nombre">
                                        <input type="text" name="slug" id="slug" class="form-control input-sm" placeholder="Nombre Corto">
                                        <select name="categorizable_type" id="categorizable_type">
                                            <option value="quote">Evento</option>
                                            <option value="services">Servicio</option>
                                        </select>
                                    <input type="submit"  value="Guardar" class="btn btn-success btn-block">
                                    <a href="{{ route('categories.index') }}" class="btn btn-info btn-block" >Atrás</a>
                        </form>
                        @endsection
