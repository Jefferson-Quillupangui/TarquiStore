@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <h1><i class="fas fa-user-cog"></i> Lista de roles</h1>
@stop

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

@section('content')

    @include('partials.session-status')

    <div class="card">

        <div class="card-header">
            <a href="{{route('admin.roles.create')}}" class="btn btn-info">
                <i class="fas fa-plus-square"></i> Crear rol
            </a>
        </div>

        <div class="card-body">
            <table class="table table-striped" id="roles">
                <thead style="background-color:#17A2B8;color:white;">
                    <tr>
                        <th>Cod</th>
                        <th>Name</th>
                        <th><div class="row justify-content-center" >Acciones</div></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role )
                        <tr>
                            <td>{{ $role->id}}</td>
                            <td>{{ $role->name}}</td>
                            <td>
                                <div class="row mr-1" style="justify-content: flex-end">
                                    <form action="{{route('admin.roles.destroy',$role)}}" method="POST" class="op-eliminar">
                                        
                                        @method('delete')
                                        @csrf
                                        <div class="btn-group mr-1">
                                            @if($role->id <> 1 && $role->id <> 2)
                                                <a class="btn btn-secondary" href="{{route('admin.roles.edit',$role)}}"><i class="fas fa-edit"></i></a>
                                                <button class="btn btn-danger" type="submit"><i class="fas fa-trash"></i></button>
                                            @endif
                                        </div>
                                        
                                    </form>
                                </div>
                            </td>
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
    <script>
        $('#roles').DataTable({
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
            "zeroRecords": "No hay roles registrados",
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