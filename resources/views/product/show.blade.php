@extends('adminlte::page')

@section('title', 'TarquiStore')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.bootstrap4.min.css">

@stop



@section('content_header')
    <h1><i class="fas fa-store"></i> Productos</h1>
@stop

@section('content')
    
@include('partials.session-status')


<div class="card">

    <div class="card-header">
        <a href="{{ route('products.create')}}" class="btn btn-info">
            <i class="fas fa-plus-square"></i> Agregar
        </a>
    </div>

    <div class="card-body">
     <table class="table table-striped" id="productos">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Comisión</th>
                    <th>Cantidad</th>
                    <th>Porcentaje Descuento</th>
                    <th>Precio descuento</th>
                    <th>Categoria</th>
                    <th>Descripción</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product )
                    <tr>
                        <td>{{ $product->id}}</td>
                        <td>{{ $product->name}}</td>
                        <td><img src="{{ asset($product->image) }}" style="width:100px;"/></td>
                        <td>${{ $product->price}}</td>
                        <td>${{ $product->comission}}</td>
                        <td>{{ $product->quantity}} UND</td>
                        <td>{{ $product->discount}}%</td>
                        <td>${{ $product->price_discount}}</td>
                        <td>{{ $product->Category->name }}</td>
                        <td><p align="justify" >{{ $product->description}}</p></td>
                        
                        {{-- <td width="10px">
                            <a class="btn btn-secondary" href="{{route('products.edit',$product)}}">Editar</a>
                        </td>

                        <td width="10px">
                            <form action="{{route('products.destroy',$product)}}" method="POST" class="op-eliminar">
                                @method('delete')
                                @csrf

                                <button class="btn btn-danger" type="submit">Eliminar</button>
                            </form>
                        </td> --}}
                    </tr>

                @empty
                    <tr>
                        <td colspan="4">No hay productos registrados</td>
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
        $('#productos').DataTable({
           responsive: true,
           autoWidth: false,

           "language": {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
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