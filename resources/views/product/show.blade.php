@extends('adminlte::page')

@section('title', 'Productos')

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
    <h1><i class="fas fa-store"></i> Productos</h1>
@stop

@section('content')
    
@include('partials.session-status')


<div class="card">

    @can('Administrar productos')
        <div class="card-header">
            <a href="{{ route('products.create')}}" class="btn btn-info">
                <i class="fas fa-plus-square"></i> Agregar
            </a>
        </div>
    @endcan

    <div class="card-body">
     <table class="table table-striped" id="productos">
            <thead style="background-color:#17A2B8;color:white;">
                <tr>
                    {{-- <th>&nbsp;</th> --}}
                    <th>Cod</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    {{-- <th>Imagen</th> --}}
                    <th>Precio</th>
                    <th>Comisión</th>
                    <th>Cantidad</th>
                    {{-- <th>%Desc</th> --}}
                    <th>PrecioDesc</th>
                    <th>Accciones</th>
                    {{-- <th>Categoria</th>
                    <th>Descripción</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product )
                    <tr>
                        {{-- <th>&nbsp;</th> --}}
                        <td class="text-center border-0"><div class="row mx-1">000{{ $product->id}}</div></td>
                        <td><div class="row">{{ $product->name}}</div></td>
                        <td class="text-center border-0">{{ $product->Category->name }}</td>
                        {{-- <td><img src="{{ asset($product->image) }}" style="width:100px;"/></td> --}}
                        <td class="text-center border-0">$ {{ $product->price}}</td>
                        <td class="text-center border-0">$ {{ $product->comission}}</td>
                        <td class="text-center border-0">{{ $product->quantity}} UND</td>
                        {{-- <td>{{ $product->discount}}%</td> --}}
                        <td class="text-center border-0">$ {{ $product->price_discount}}</td>
                        <td class="text-center border-0">
                            <div class="row ml-auto">
                                <form action="{{route('products.destroy',$product)}}" method="POST" class="op-eliminar">
                                    {{-- <a class="btn btn-info" href="{{route('products.show',$product)}}"><i class="far fa-eye"></i></a>
                                    <a class="btn btn-secondary" href="{{route('products.edit',$product)}}"><i class="fas fa-edit"></i></a> --}}
                                    @method('delete')
                                    @csrf
                                    {{-- <div class="col mt-1 text-center">
                                        <button class="btn btn-danger" type="submit"><i class="fas fa-trash"></i></button>
                                    </div> --}}

                                    <div class="btn-group mr-3">
                                        <a class="btn btn-info btn-group-sm" href="{{route('products.show',$product)}}"><i class="far fa-eye"></i></a>
                                        @can('Administrar productos')
                                            <a class="btn btn-secondary btn-group-sm" href="{{route('products.edit',$product)}}"><i class="fas fa-edit"></i></a>{{--              
                                            <button type="button" class="btn btn-primary"><i class="far fa-eye"></i></button>
                                            <button type="button" class="btn btn-danger"><i class="far fa-eye"></i></button> --}}
                                            <button class="btn btn-danger" type="submit"><i class="fas fa-trash"></i></button>
                                        @endcan
                                    </div>
                                </form>
                            </div>
                        </td>
                        {{-- <td>{{ $product->Category->name }}</td>
                        <td><div class="row ml-auto">{{ $product->description}}</div></td> --}}
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
        $('#productos').DataTable({
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
            "zeroRecords": "No hay productos registrados",
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