@extends('adminlte::page')

@section('title', 'TarquiStore')

@section('content_header')
    <h1>Editar Rol</h1>
@stop

@section('content')

    @include('partials.session-status')
    
    <div class="card">
        <div class="card-body">
            {!! Form::model($category,['route' => ['categories.update', $category], 'method' => 'put']) !!}
                
            @include('category.partials.form')  

                {!! Form::submit('Guardar', ['class' => 'btn btn-primary mt-2']) !!}  
                
                <a class="btn btn-link "
                href="{{ route('categories.index') }}">
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