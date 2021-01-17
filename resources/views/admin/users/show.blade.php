@extends('adminlte::page')

@section('title', 'TarquiStore')

@section('content_header')
    <h1>Lista de usuarios</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        Swal.fire(
        'Good job!',
        'You clicked the button!',
        'success'
      )
    </script>
@stop