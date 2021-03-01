@extends('adminlte::page')

@section('title', 'TarquiStore')

@section('content_header')
    <h1> <i class="fab fa-creative-commons-share"></i> Registrar Cliente</h1>
@stop

@section('css')
    <style  type="text/css">textarea{ resize : none;}</style>
@stop

@section('content')
<form action="{{ route('validar.identificacion') }}" id="form-validar-identificacion" class="d-none"></form>


    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'clients.store', 'id' => 'formulario']) !!}
                
                @include('clientes.partials.form')  

                {!! Form::submit('Guardar', ['class' => 'btn btn-info mt-2', 'id'=>'btn-guardar', 'guardar' => 1]) !!}   
                
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
        <script type="text/javascript" src="{{ asset("js/adminlte/validacion/verificacionDocumento.js") }}"></script>
@stop