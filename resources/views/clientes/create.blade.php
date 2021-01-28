@extends('adminlte::page')

@section('title', 'TarquiStore')

@section('content_header')
    <h1> <i class="fab fa-creative-commons-share"></i> Registrar Cliente</h1>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style  type="text/css">textarea{ resize : none;}</style>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'clients.store', 'id' => 'formulario']) !!}
                
                @include('clientes.partials.form')  

                {!! Form::submit('Guardar', ['class' => 'btn btn-info mt-2']) !!}   
                
                <a class="btn btn-link "
                    href="{{ route('clients.index') }}">
                    Regresar
                </a>  

            {!! Form::close() !!}
        </div>    
    </div>    
@stop

@section('js')
        <script type="text/javascript" src="{{ asset("js/adminlte/validacion/identificacion.js") }}"></script>
@stop