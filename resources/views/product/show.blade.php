@extends('adminlte::page')

@section('title', 'TarquiStore')

@section('content_header')
    <h1>Productos</h1>
@stop

@section('content')
    
@include('partials.session-status')

<div class="card">

    <div class="card-header">
        <a href="{{ route('products.create')}}">Crear Productos</a>
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
                    <th colspan="2"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product )
                    <tr>
                        <td>{{ $product->id}}</td>
                        <td>{{ $product->name}}</td>
                        <td>{{ $product->image}}</td>
                        <td>{{ $product->price}}</td>
                        <td>{{ $product->description}}</td>
                        <td>{{ $product->comission}}</td>
                        <td>{{ $product->quantity}}</td>
                        
                        <td width="10px">
                            <a class="btn btn-secondary" href="{{route('products.edit',$product)}}">Editar</a>
                        </td>

                        <td width="10px">
                            <form action="{{route('products.destroy',$product)}}" method="POST">
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

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop