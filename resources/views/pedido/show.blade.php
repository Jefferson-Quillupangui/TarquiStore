@extends('adminlte::page')

@section('title', 'TarquiStore')

@section('content_header')
    <h1><i class="fas fa-th-large"></i> Revisión de pedidos</h1>
@stop

@section('css')
    <link rel="stylesheet" href="/css/app.css">
@stop

@section('content')
    
@include('partials.session-status')

<div class="card">

    <div class="card-header">
        <a href="#" class="btn btn-info">
            <i></i>Lista de pedidos</a>
    </div>

    <div class="card-body">
        <table class="table table-striped">
            <tbody>
            </tbody>
        </table>
    </div>
</div>
@stop

@section('js')

@stop