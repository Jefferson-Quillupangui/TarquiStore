@extends('adminlte::page')

@section('title', 'Clientes')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.bootstrap4.min.css">
@stop

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
        <table class="table table-striped" id="clientes">
            <thead>
                <tr>
                    <th>Identificación</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Contacto</th>
                    <th>Dirección</th>
                    <th>Correo</th>
                    <th>Acciones</th>                                      
                </tr>
            </thead>
            <tbody>
                @forelse($clients as $client )
                    <tr>
                        <td>{{ $client->identification}}</td>
                        <td>{{ $client->name}}</td>
                        <td>{{ $client->last_name}}</td>
                        <td>{{ $client->phone1."  ".$client->phone2}}</td>
                        <td><div class="row ml-auto">{{ $client->address}}</div></td>
                        <td><div class="row ml-auto">{{ $client->email}}</div></td>
                        <td>
                            <div class="row ml-auto">
                            <form action="{{route('clients.destroy',$client)}}" method="POST" class="op-eliminar">
                                <a class="btn btn-secondary" href="{{route('clients.edit',$client)}}"><i class="fas fa-edit"></i></a>
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger" type="submit"><i class="fas fa-trash"></i></button>
                            </div>
                            </form>
                        </td>
                        {{-- <td>{{ $client->created_at->diffForHumans()}}</td> --}}
                    </tr>

                @empty
                    
                    <tr>
                        <td colspan="4">No hay clientes registrados</td>
                    </tr>

                @endforelse

            </tbody>
        </table>
    </div>
</div>
@stop



@section('js')
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap4.min.js"></script>
    <script>
        $('#clientes').DataTable({
        responsive: true,
        autoWidth: false,

        "language": {
            "lengthMenu": "Mostrar "+ 
                            `<select class="custom-select custom-select-sm form-control form-control-sm">
                                <option value = '10'>10</option>
                                <option value = '25'>25</option>
                                <option value = '50'>50</option>
                                <option value = '100'>100</option>
                                <option value = '-1'>Todos</option>
                            </select>`+ " registros por pagina",
            "zeroRecords": "No se encontró nada",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            'search': 'Buscar:',
            'paginate': {
                'next': 'Siguiente',
                'previous': 'Anterior'
                }
            }   
        });
    </script>
    <script type="text/javascript" src="{{ asset("js/adminlte/modales/windeliminar.js") }}"></script>
@stop