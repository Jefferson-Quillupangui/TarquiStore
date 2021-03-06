@extends('adminlte::page')

@section('title', 'Categorias')

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
    <h1><i class="fas fa-tag"></i> Categorias</h1>
@stop

@section('content')
    
@include('partials.session-status')

<div class="card">

    @can('Administrar categorias')
    <div class="card-header">
        <a href="{{ route('categories.create')}}" class="btn btn-info">
            <i class="fas fa-plus-square"></i> Crear categoria
        </a>
    </div>
    @endcan

    <div class="card-body">
        <table class="table table-striped" id="categorias">
            <thead style="background-color:#17A2B8;color:white;">
                <tr>
                    <th>Cod</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category )
                    <tr>
                        <td>{{ $category->id}}</td>
                        <td>{{ $category->name}}</td>
                        <td>{{ $category->description}}</td>
                        <td >
                            <div class="row">
                                <form action="{{route('categories.destroy',$category)}}" method="POST" class="op-eliminar">
                                    
                                    @method('delete')
                                    @csrf
                                    <div class="btn-group ml-3">
                                        <a class="btn btn-info btn-group-sm" href="{{route('categories.show',$category)}}"><i class="far fa-eye"></i></i></a>
                                        @can('Administrar categorias')
                                            <a class="btn btn-secondary btn-group-sm" href="{{route('categories.edit',$category)}}"><i class="fas fa-edit"></i></a>
                                            <button class="btn btn-danger" type="submit"><i class="fas fa-trash"></i></button>
                                        @endcan
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
        $('#categorias').DataTable({
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
            "zeroRecords": "No hay categorias registradas",
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