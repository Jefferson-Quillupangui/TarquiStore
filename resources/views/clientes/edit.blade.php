@extends('adminlte::page')

@section('title', 'TarquiStore')

@section('content_header')
    <h1><i class="fas fa-pencil-alt"></i> Editar cliente</h1>
@stop

@section('css')

@stop

@section('content')
    <form action="{{ route('validar.identificacion') }}" id="form-validar-identificacion" class="d-none"></form>
    @include('partials.session-status')

    <div class="card">
        <div class="card-body">
            {!! Form::model($client, ['route' => ['clients.update', $client], 'method' => 'put']) !!}

            @include('clientes.partials.form')

            {!! Form::submit('Guardar', ['class' => 'btn btn-info mt-2', 'id' => 'btn-guardar' , 'editar' => 0]) !!}

            <a class="btn btn-link " href="{{ route('clients.index') }}">
                Regresar
            </a>

            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('js')
    <script>
        console.log('Hi!');

    </script>
    <script type="text/javascript" src="{{ asset('js/adminlte/validacion/verificacionDocumento.js') }}"></script>
@stop
