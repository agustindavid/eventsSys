@extends('layouts.sidebar')

@section('pageTitle', setting('app_name', 'default value'))

@section('content')

@include('app_settings::_settings')

@endsection
