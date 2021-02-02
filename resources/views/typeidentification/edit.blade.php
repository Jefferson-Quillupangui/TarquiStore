@extends('adminlte::page')

@section('title', 'TarquiStore')

@section('content_header')
    <h1><i class="fas fa-pencil-alt"></i> Editar tipo de identificación</h1>
@stop

@section('content')

    @include('partials.session-status')

    <div class="card">
        <div class="card-body">
            {{-- {!!  Form::model($type_identification, ['route' => ['type_identification.update', $type_identification], 'method' => 'put']) !!} --}}

            {!! Form::model($codigo, ['route' => ['type_identification.update', $codigo], 'method' => 'put']) !!}
            @include('typeidentification.partials.form')

            {!! Form::submit('Guardar', ['class' => 'btn btn-info mt-2']) !!}

            <a class="btn btn-link " href="{{ route('type_identification.index') }}">
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
    <style type="text/css">
        textarea {
            resize: none;
        }

    </style>
@stop
