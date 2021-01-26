@extends('adminlte::page')

@section('title', 'TarquiStore')

@section('content_header')
    <h1><i class="fas fa-pencil-alt"></i> Asignar un rol</h1>
@stop

@section('content')

@include('partials.session-status')

    <div class="card">
        <div class="card-body">
            <h1 class="h5">Nombre</h1>
            <p class="form-control" >{{$user->name}}</p>
            
            <h1 class="h5">Lista de roles</h1>
            {!! Form::model($user, ['route' => ['admin.users.update', $user], 'method' => 'put' ]) !!}
                @foreach ($roles as $role)
                    <div>
                        <label>
                            {!! Form::checkbox('roles[]',$role->id, null, ['class' => 'mr-1']) !!}
                            {{ $role->name}}
                        </label>
                    </div>
                @endforeach

                {!! Form::submit('Asignar Rol', ['class' => 'btn btn-info mt-2']) !!}  

                <a class="btn btn-link "
                href="{{ route('admin.users.index') }}">
                Regresar
                </a>  

            {!! Form::close() !!}

        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop