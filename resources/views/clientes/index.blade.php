@extends('adminlte::page')

@section('title', 'Clientes')

@section('css')
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.bootstrap4.min.css"> --}}

    <link rel="stylesheet" href="{{ asset("datatables/css/bootstrap.css") }}">
    <link rel="stylesheet" href="{{ asset("datatables/css/dataTables.bootstrap4.min.css") }}">
    <link rel="stylesheet" href="{{ asset("datatables/css/responsive.bootstrap4.min.css") }}">
    <style>
        .page-item.active .page-link {
            background-color: #17A2B8 !important;
            border: 1px solid #17A2B8;
            color: white !important;
        }
        .page-link {
            color: black !important;
        }
    </style>
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
            <thead style="background-color:#17A2B8;color:white;">
                <tr>
                    <th>Identificación</th>
                    <th>Nombre</th>
                    {{-- <th>Apellido</th> --}}
                    <th>Contacto</th>
                    {{-- <th>Dirección</th>
                    <th>Correo</th> --}}
                    <th>Acciones</th>                                      
                </tr>
            </thead>
            <tbody>
                @foreach($clients as $client )
                    <tr>
                        <td>@if($client->identification){{ $client->identification}} @else N/A @endif</td>
                        <td>{{ $client->name}} {{ $client->last_name}}</td>
                        {{-- <td>{{ $client->last_name}}</td> --}}
                        <td>{{ $client->phone1." / ".$client->phone2}}</td>
                        {{-- <td><div class="row ml-auto">{{ $client->address}}</div></td>
                        <td><div class="row ml-auto">{{ $client->email}}</div></td> --}}
                        <td>
                            <div class="row ml-auto">
                            <form action="{{route('clients.destroy',$client)}}" method="POST" class="op-eliminar">
                                
                                @method('delete')
                                @csrf
                                <div class="btn-group mr-3">
                                    <a class="btn btn-info btn-group-sm" href="{{route('clients.show',$client)}}"><i class="far fa-eye"></i></a>
                                    <a class="btn btn-secondary btn-group-sm" href="{{route('clients.edit',$client)}}"><i class="fas fa-edit"></i></a>
                                    <button class="btn btn-danger" type="submit"><i class="fas fa-trash"></i></button>
                                </div>
                            </form>
                            </div>
                        </td>
                        {{-- <td>{{ $client->created_at->diffForHumans()}}</td> --}}
                    </tr>

                @endforeach

            </tbody>
        </table>
    </div>
</div>
@stop



@section('js')
    {{-- <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap4.min.js"></script> --}}
    <script type="text/javascript" src="{{ asset("datatables/js/jquery.dataTables.min.js") }}"></script>
    <script type="text/javascript" src="{{ asset("datatables/js/dataTables.bootstrap4.min.js") }}"></script>
    <script type="text/javascript" src="{{ asset("datatables/js/dataTables.responsive.min.js") }}"></script>
    <script type="text/javascript" src="{{ asset("datatables/js/responsive.bootstrap4.min.js") }}"></script>
    <script type="text/javascript" src="{{ asset("js/adminlte/modales/windeliminar.js") }}"></script>
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
            "zeroRecords": "No hay clientes registrados",
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

@stop