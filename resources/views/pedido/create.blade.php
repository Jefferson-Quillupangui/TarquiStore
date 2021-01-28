@extends('adminlte::page')

@section('title', 'TarquiStore')

@section('css')
    <link href="{{ asset('/plugin_tabullator/dist/css/tabulator.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop


<style type="text/css">
    .loaders {
     position: fixed;
     left: 0px;
     top: 0px;
     width: 100%;
     height: 100%;
     z-index: 9999;
     background: url('{{ asset("/gif/load.gif")}}') 50% 50% no-repeat rgb(249,249,249);
     opacity: .8;
 }
 </style>
 

@section('content_header')
    <h1> <i class="fab fa-creative-commons-share"></i> Registrar pedido</h1>
@stop

@section('content')
<div class="loaders d-none"></div>
<form action="{{route('clientes.lista')}}" id="form-listarclientes"></form>
<div class="form-group">
    <div class="row">
        <div class="col-md-5">
            <label for="name_client">Cliente:</label>
            <div class="input-group mb-3">
                <input type="search" class="form-control rounded" placeholder="Buscar cliente" aria-label="Search"
                  aria-describedby="search-addon" id="textbuscarcliente" codigocliente=0 disabled/>
                <button type="button" id="btn-buscarpersona" class="btn btn-outline-primary">Buscar </button>
              </div>
        </div>
        <div class="col-md-5">
            <label for="identification">Identificación:</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="far fa-keyboard"></i></span>
                </div>
                {!! Form::text('identification',null,['class' => 'form-control' . ($errors->has('identification') ? ' is-invalid' : ''), 
                                                    'placeholder' => 'Identificación', 
                                                    'id' => 'textidentification',
                                                    'disabled']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <label for="name">Fecha de entrega:</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="far fa-keyboard"></i></span>
                </div>
                {!! Form::text('name',null,['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Nombre del producto']) !!}
                @error('name')
                <span class="invalid-feedback">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>
        </div>
            <div class="col-md-5">
                <label for="address_delivery">Dirección/Ubicación:</label>
                <div class="input-group mb-3 ">
                    <div class="input-group resize:none">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="far fa-keyboard"></i></span>
                        </div>
                        {!! Form::textarea('address_delivery',null,['class' => 'form-control' . ($errors->has('address_delivery') ? ' is-invalid' : ''), 
                                                                    'placeholder' => 'Ingrese descripción del producto', 
                                                                    'rows' => '4 ',
                                                                    'id' => 'textaddressdelivery',
                                                                    'spellcheck' => "false"]) !!}
                      </div>
                    @error('address_delivery')
                    <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror 
                </div>  
            </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <label for="price">Total Orden:</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="far fa-keyboard"></i></span>
                </div>
                {!! Form::number('price',null,['class' => 'form-control' . ($errors->has('price') ? ' is-invalid' : ''), 'placeholder' => 'Precio de venta del producto','step'=>'any']) !!}
                @error('price')
                <span class="invalid-feedback">
                    <strong>{{$message}}</strong>
                </span>
                @enderror 
            </div>  
            <label for="comission">Total Comision:</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="far fa-keyboard"></i></i></span>
                </div>
                {!! Form::number('comission',null,['class' => 'form-control' . ($errors->has('comission') ? ' is-invalid' : ''), 'placeholder' => 'Valor de comisión del producto','step'=>'any']) !!}
                @error('comission')
                <span class="invalid-feedback">
                    <strong>{{$message}}</strong>
                </span>
                @enderror 
            </div>  
        </div>

    </div>
    <div class="row">
        <div class="col-md-5">
            <label for="discount">Observacion:</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="far fa-keyboard"></i></span>
                </div>
                {!! Form::number('discount',null,['class' => 'form-control' . ($errors->has('discount') ? ' is-invalid' : ''), 'placeholder' => 'Valor de descuento del producto','step'=>'any']) !!}
                @error('discount')
                <span class="invalid-feedback">
                    <strong>{{$message}}</strong>
                </span>
                @enderror 
            </div>   
        </div>
        <div class="col-md-5">
            <label for="category">Categorias:</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="far fa-list-alt"></i></span>
                </div>
                    {!! Form::select('category', $category,0,['class' => 'custom-select']) !!}
                @error('category')
                <span class="invalid-feedback">
                    <strong>{{$message}}</strong>
                </span>
                @enderror 
            </div>   
        </div>
    </div>
    <div class="row">
      <div class="col-md-5">
            <form action="{{route('orden.create')}}" id="form-crearorden" method="POST">
                {{-- @csrf --}}
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

                <button class="btn btn-danger" id="btn-generarorden" type="button">Accion</button>
            </form>
      </div>
    </div>
        
</div>

@include('pedido.ordertable')

    <!-- Modal -->
    <div class="modal fade" id="modal-buscarpersona" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Lista de clientes</h5>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button> --}}
                </div>
                <div class="modal-body">
                        <div class="row">
                            <div  id="clientes-table"></div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btn-cancelar-pedido" class="btn btn-danger">Cancelar</button>
                    <button type="button" id="btn-guardar-estb" class="btn btn-success">Guardar</button>
                </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script type="text/javascript" src="{{ asset('/plugin_tabullator/dist/js/tabulator.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset("js/adminlte/pedidos/pedidos.js") }}"></script>
@stop