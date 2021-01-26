@extends('adminlte::page')

@section('title', 'TarquiStore')

@section('content_header')
    <h1> <i class="fab fa-creative-commons-share"></i> Agregar ciudad</h1>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'ciudades.store']) !!}
                
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

@section('js')
    <script> console.log('Hi!'); </script>
@stop