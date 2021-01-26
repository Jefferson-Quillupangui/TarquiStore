@extends('adminlte::page')

@section('title', 'TarquiStore')

@section('content_header')
    <h1><i class="fas fa-tag"></i> Tipos de identificación</h1>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('content')
    
@include('partials.session-status')

<div class="card">

    <div class="card-header">
        <a href="{{ route('type_identification.create')}}" class="btn btn-info">
            <i class="fas fa-plus-square"></i> Agregar</a>
    </div>

    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th colspan="2"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($type_identifications as $type_identification )
                    <tr>
                        <td>{{ $type_identification->id}}</td>
                        <td>{{ $type_identification->name}}</td>
                        
                        <td width="10px">
                            <a class="btn btn-secondary" href="{{route('type_identification.edit',$type_identification)}}">Editar</a>
                        </td>

                        <td width="10px">
                            <form action="{{route('type_identification.destroy',$type_identification)}}" method="POST" class="op-eliminar">
                                @method('delete')
                                @csrf

                                <button class="btn btn-danger" type="submit">Eliminar</button>
                            </form>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="4">No hay ninguna sector registrado</td>
                    </tr>

                @endforelse

            </tbody>
        </table>
    </div>
</div>
@stop

@section('js')
    <script type="text/javascript" src="{{ asset("js/adminlte/modales/windeliminar.js") }}"></script>
@stop