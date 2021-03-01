@extends('adminlte::page')

@section('title', 'TarquiStore')

@section('content_header')
    <h1><i class="fas fa-pencil-alt"></i>Editar Rol</h1>
@stop

@section('content')

    @include('partials.session-status')
    
    <div class="card">
        <div class="card-body">
            {!! Form::model($role,['route' => ['admin.roles.update', $role], 'method' => 'put']) !!}
                
                @include('admin.roles.partials.form')  

                {!! Form::submit('Actualizar', ['class' => 'btn btn-info mt-2']) !!}     

                <a class="btn btn-link"
                href="{{ route('admin.roles.index') }}">
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