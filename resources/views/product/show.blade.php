@extends('adminlte::page')

@section('title', 'TarquiStore')

@section('css')
    <link rel="stylesheet" href="/css/app.css">
@stop

@section('content_header')
    <h1><i class="fas fa-gifts"></i> Productos</h1>
@stop

@section('content')
    
@include('partials.session-status')

<div class="card">

    <div class="card-header">
        <a href="{{ route('products.create')}}" class="btn btn-info">
            <i class="fas fa-plus-square"></i> Crear Productos
        </a>
    </div>

    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Descripción</th>
                    <th>Comisión</th>
                    <th>Cantidad</th>
                    <th>Descuento</th>
                    <th>Categoria</th>
                    <th colspan="2"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product )
                    <tr>
                        <td>{{ $product->id}}</td>
                        <td>{{ $product->name}}</td>
                        <td><img src="{{ asset($product->image) }}" style="width:300px;"/></td>
                        <td>${{ $product->price}}</td>
                        <td>{{ $product->description}}</td>
                        <td>${{ $product->comission}}</td>
                        <td>{{ $product->quantity}}</td>
                        <td>{{ $product->discount}}%</td>
                        <td>{{ $product->Category->name }}</td>
                        
                        <td width="10px">
                            <a class="btn btn-secondary" href="{{route('products.edit',$product)}}">Editar</a>
                        </td>

                        <td width="10px">
                            <form action="{{route('products.destroy',$product)}}" method="POST" class="op-eliminar">
                                @method('delete')
                                @csrf

                                <button class="btn btn-danger" type="submit">Eliminar</button>
                            </form>
                        </td>
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
    <script type="text/javascript" src="{{ asset("js/adminlte/modales/windeliminar.js") }}"></script>
   
@stop