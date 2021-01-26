@extends('adminlte::page')

@section('title', 'TarquiStore')

@section('content_header')
    <h1><i class="fas fa-pencil-alt"></i> Editar ciudad</h1>
@stop

@section('content')

    @include('partials.session-status')
    
    <div class="card">
        <div class="card-body">
            {!! Form::model($city,['route' => ['ciudades.update', $city], 'method' => 'put']) !!}
                
            @include('ciudad.partials.form')  

                {!! Form::submit('Guardar', ['class' => 'btn btn-info mt-2']) !!}  
                
                <a class="btn btn-link "
                href="{{ route('ciudades.index') }}">
                Regresar
                </a>  

            {!! Form::close() !!}
        </div>    
    </div>    
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop