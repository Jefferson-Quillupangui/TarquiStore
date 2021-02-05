@extends('adminlte::page')

@section('title', 'TarquiStore')

@section('css')
    <link rel="stylesheet" href="/css/app.css">
@stop

@section('content_header')
    <h1><i class="fas fa-users"></i> Lista de Usuarios</h1>
@stop

@section('content')
    @livewire('admin-users')
@stop

@section('js')
@stop 