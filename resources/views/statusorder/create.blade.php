@extends('adminlte::page')

@section('title', 'TarquiStore')

@section('content_header')
    <h1> <i class="fab fa-creative-commons-share"></i> Agregar estado</h1>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'status_order.store']) !!}
                
                @include('statusorder.partials.form')  

                {!! Form::submit('Guardar', ['class' => 'btn btn-info mt-2']) !!}   
                
                <a class="btn btn-link "
                    href="{{ route('status_order.index') }}">
                    Regresar
                </a>  

            {!! Form::close() !!}
        </div>    
    </div>    
@stop

@section('js')
    <style  type="text/css">textarea{ resize : none;}</style>
@stop