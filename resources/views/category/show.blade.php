@extends('adminlte::page')

@section('title', 'TarquiStore')

@section('content_header')
    <h1>Categorias</h1>
@stop

@section('content')
    
@include('partials.session-status')

<div class="card">

    <div class="card-header">
        <a href="{{ route('categories.create')}}">Crear categoria</a>
    </div>

    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th colspan="2"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category )
                    <tr>
                        <td>{{ $category->id}}</td>
                        <td>{{ $category->name}}</td>
                        <td>{{ $category->description}}</td>
                        
                        <td width="10px">
                            <a class="btn btn-secondary" href="{{route('categories.edit',$category)}}">Editar</a>
                        </td>

                        <td width="10px">
                            <form action="{{route('categories.destroy',$category)}}" method="POST">
                                @method('delete')
                                @csrf

                                <button class="btn btn-danger" type="submit">Eliminar</button>
                            </form>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="4">No hay ninguna categoria registrada</td>
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