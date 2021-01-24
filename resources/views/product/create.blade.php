@extends('adminlte::page')

@section('title', 'TarquiStore')

@section('content_header')
    <h1> <i class="fab fa-creative-commons-share"></i> Ingresar producto</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'products.store', 'method' => 'POST', 'files' => true]) !!}
                
                @include('product.partials.form')  

                {!! Form::submit('Guardar', ['class' => 'btn btn-info mt-2']) !!}   
                
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
    <style  type="text/css">textarea{ resize : none;}</style>
@stop

@section('js')

@stop