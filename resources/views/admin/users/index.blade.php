@extends('adminlte::page')

@section('title', 'TarquiStore')

@section('content_header')
    <h1><i class="fas fa-users"></i> Lista de Usuarios</h1>
@stop

@section('content')
    @livewire('admin-users')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop 