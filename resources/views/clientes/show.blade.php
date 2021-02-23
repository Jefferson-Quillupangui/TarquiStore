@extends('adminlte::page')

@section('title', 'Cliente')

@section('content_header')
    {{-- <h1><i class="fas fa-users"></i> Detalles del producto:</h1> --}}
@stop

@section('content')

    <div class="card card-cyan">

      <div class="card-header">
              <h5><i class="fas fa-user"></i> Cliente</h5>
      </div>

      <div class="card-body">
        <div class="row mt-2">

          <div class="col-md-3 col-sm-3 ml-4"> 

              <div class="imguser" >
                @if($client->sex=='H') 
                    <img src="{{ asset('/img/man.png') }}" class="float-left rounded-circle mr-2">
                @else
                    <img src="{{ asset('/img/woman.png') }}" class="float-left rounded-circle mr-2">
                @endif 
              </div>

          </div>

          <div class="col-md-3 col-sm-3 col-lg-6 ml-4 mt-2"> 

            <h1>{{ $client->name }}</h1>
            <h3>{{ $client->email }}</h3>
  
            <p class="my-4">
              <strong>Identificación</strong>: {{ $client->identification }}<br>
              <strong>Teléfono</strong>:  {{ $client->phone1 }} @if($client->phone2) / {{ $client->phone2 }} @endif <br>
              <strong>Dirección</strong>: {{ $client->address }}<br>
              <strong>Sexo</strong>:  @if($client->sex=='H') <span class="badge badge-info">Hombre</span> @else <span class="badge badge-danger">Mujer</span> @endif <br>
            </p>
            
          </div>

        </div>

        <div class="mt-4">
          <a class="btn btn-info btn-md mr-1 mb-2 text-white" href="{{route('clients.index')}}" >
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