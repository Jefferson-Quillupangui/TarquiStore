@extends('adminlte::page')

@section('title', 'TarquiStore')

@section('css')
    <link href="{{ asset('/jquery_toast_plugin/css/jquery.toast.css') }}" rel="stylesheet">
@stop

@section('content_header')
    <h1><i class="fas fa-key"></i> Cambiar contraseña</h1>
@stop

@section('content')

@include('partials.session-status')

<form action="{{ route('validar.identificacion') }}" id="form-validar-identificacion" class="d-none"></form>

    <div class="card">
        <div class="card-body">
            
            {{-- <h1 class="h5">Nombre</h1>
            <p class="form-control col-md-6" >{{$user->name}}</p> --}}
            
                     
            {!! Form::model($user, ['route' => ['admin.user.update.pass', $user], 'method' => 'put' ]) !!}
                    
                <div class="form-group">
                        <div class="row">
                            <div class="col-md-5">
                                <label for="password">Contraseña</label>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                                    </div>
                                {!! Form::password('password',['class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''), 'placeholder' => 'Contraseña', 'autofocus','required' => true]) !!}
                                @error('password')
                                    <span class="invalid-feedback">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror 

                                </div> 

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">

                                <label for="password_confirmation">Confirmar contraseña</label>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                                    </div>
                                {!! Form::password('password_confirmation',['class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''), 'placeholder' => 'Vuelva a escribir la contraseña', 'required' => true]) !!}
                                </div> 

                            </div>
                        </div>
                    </div>

                    {!! Form::submit('Actualizar', ['class' => 'btn btn-info mt-2', 'id' => 'btn-actualizar']) !!}  

                    <a class="btn btn-link "
                    href="{{ route('admin.users.edit', $user) }}">
                    <i class="fas fa-arrow-circle-left"></i>
                    Regresar
                    </a>  
    
                    {!! Form::close() !!}

                </div>
        </div>

@stop

@section('js')

@stop