@extends('adminlte::page')

@section('title', 'Sectores')

@section('content_header')
    <h1><i class="fas fa-th-large""></i> Sectores</h1>
@stop

@section('css')
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
        <a href="{{ route('sectors.create')}}" class="btn btn-info">
            <i class="fas fa-plus-square"></i> Agregar sectores</a>
    </div>

    <div class="card-body">
        <table class="table table-striped" id="sectores">
            <thead style="background-color:#17A2B8;color:white;">
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sectors as $sector )
                    <tr>
                        <td>{{ $sector->codigo}}</td>
                        <td>{{ $sector->name}}</td>               
                        <td>
                            <div class="row mr-1" style="justify-content: flex-end">
                                <form action="{{route('sectors.destroy',$sector)}}" method="POST" class="op-eliminar">
                                    <a class="btn btn-secondary" href="{{route('sectors.edit',$sector)}}"><i class="fas fa-edit"></i></a>
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-danger" type="submit"><i class="fas fa-trash"></i></button>
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
    <script type="text/javascript" src="{{ asset("datatables/js/jquery.dataTables.min.js") }}"></script>
    <script type="text/javascript" src="{{ asset("datatables/js/dataTables.bootstrap4.min.js") }}"></script>
    <script type="text/javascript" src="{{ asset("datatables/js/dataTables.responsive.min.js") }}"></script>
    <script type="text/javascript" src="{{ asset("datatables/js/responsive.bootstrap4.min.js") }}"></script>
    <script>
        $('#sectores').DataTable({
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
            "zeroRecords": "No se encontraron sectores registrados",
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