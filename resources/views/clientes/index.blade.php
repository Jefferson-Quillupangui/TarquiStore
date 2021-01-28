@extends('adminlte::page')

@section('title', 'TarquiStore')

@section('content_header')
    <h1><i class="fas fa-address-book"></i> Clientes</h1>
@stop

@section('content')
    
@include('partials.session-status')

<div class="card">

    <div class="card-header">
        <a href="{{ route('clients.create')}}" class="btn btn-info">
            <i class="fas fa-plus-square"></i> Nuevo Cliente
        </a>
    </div>

    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Identificación</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Dirección</th>
                    <th>Telefono</th>
                    <th>Correo</th>
                    <th colspan="2"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($clients as $client )
                    <tr>
                        <td>{{ $client->identification}}</td>
                        <td>{{ $client->name}}</td>
                        <td>{{ $client->last_name}}</td>
                        <td>{{ $client->address}}</td>
                        <td>{{ $client->phone1."  ".$client->phone2}}</td>
                        <td>{{ $client->email}}</td>
                        
                        <td width="10px">
                            <a class="btn btn-secondary" href="{{route('clients.edit',$client)}}">Editar</a>
                        </td>

                        <td width="10px">
                            <form action="{{route('clients.destroy',$client)}}" method="POST" class="op-eliminar">
                                @method('delete')
                                @csrf

                                <button class="btn btn-danger" type="submit">Eliminar</button>
                            </form>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="4">No hay clientes registrados</td>
                    </tr>

                @endforelse

            </tbody>
        </table>

        {!! $clients->links() !!}

    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script type="text/javascript" src="{{ asset("js/adminlte/modales/windeliminar.js") }}"></script>
@stop