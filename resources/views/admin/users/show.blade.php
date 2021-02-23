@extends('adminlte::page')

@section('title', 'Usuario')

@section('content_header')
    {{-- <h1><i class="fas fa-users"></i> Detalles del producto:</h1> --}}
@stop

@section('content')

    <div class="card card-cyan">

      <div class="card-header">
              <h5><i class="fas fa-user"></i> Usuario</h5>
      </div>

      <div class="card-body">
        <div class="row mt-2">

          <div class="col-md-3 col-sm-3 ml-4"> 

            @if($user->profile_photo_path)
              <div class="imguser" >
                <img src="{{ asset("storage/".$user->profile_photo_path)}}" class="float-left rounded-circle mr-2">
              </div>            
            @else
              <div class="imguser" >
                <img src="{{ asset('/img/user.svg') }}" class="float-left rounded-circle mr-2">
              </div>
            @endif

          </div>

          <div class="col-md-3 col-sm-3 col-lg-6 ml-4 mt-2"> 

            <h1>{{$user->name}}</h1>
            <h3>{{$user->email}}</h3>
  
            <p class="my-4">
              <strong>Identificación</strong>: {{$colaborador->identification}}<br>
              <strong>Teléfono</strong>: {{$colaborador->phone}}<br>
              <strong>Estado</strong>: @if($colaborador->status=='A') Activo @else Inactivo @endif <br>
              <strong>Edad</strong>: {{ $edad }}<br>
              <strong>Sexo</strong>:  @if($colaborador->sex=='H') Hombre @else Mujer @endif <br>
              <strong>Roles</strong>:  <span class="badge badge-info">{{$user->getRoleNames()->implode(', ')}}</span><br><br>
            </p>
            
          </div>

        </div>

        <div class="mt-4">
          <a class="btn btn-info btn-md mr-1 mb-2 text-white" href="{{route('admin.users.index')}}" >
            <i class="fas fa-long-arrow-alt-left pr-2"></i>Regresar</a>
        </div>

    </div>
  </div>

@stop

@section('css')
  <style>
   .imguser img {      
      border: 1px solid #ddd;
      border-radius: 50%;
      padding: 5px;
      width: 250px;
      height: 250px;
      }
  </style>
@stop

@section('js')

@stop