@extends('adminlte::page')

@section('title', 'TarquiStore')

@section('content_header')
    <h1><i class="fas fa-tag"></i> Ciudades</h1>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('content')
    
@include('partials.session-status')

<div class="card">

    <div class="card-header">
        <a href="{{ route('ciudades.create')}}" class="btn btn-info">
            <i class="fas fa-plus-square"></i> Agregar ciudad</a>
    </div>

    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th colspan="2"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($cities as $city )
                    <tr>
                        <td>{{ $city->id}}</td>
                        <td>{{ $city->name}}</td>
                        
                        <td width="10px">
                            <a class="btn btn-secondary" href="{{route('ciudades.edit',$city)}}">Editar</a>
                        </td>

                        <td width="10px">
                            <form action="{{route('ciudades.destroy',$city)}}" method="POST" class="op-eliminar">
                                @method('delete')
                                @csrf

                                <button class="btn btn-danger" type="submit">Eliminar</button>
                            </form>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="4">No hay ninguna categoria registrada</td>
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