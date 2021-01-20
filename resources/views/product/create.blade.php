@extends('adminlte::page')

@section('title', 'TarquiStore')

@section('content_header')
    <h1>Crear categoria</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'products.store']) !!}
                
                @include('product.partials.form')  

                {!! Form::submit('Guardar', ['class' => 'btn btn-primary mt-2']) !!}   
                
                <a class="btn btn-link "
                    href="{{ route('products.index') }}">
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