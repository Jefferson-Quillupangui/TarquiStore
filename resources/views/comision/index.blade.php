@extends('adminlte::page')

@section('title', 'Comisiones')

@section('content_header')
    <h1><i class="fas fa-user-cog"></i>Comisiones</h1>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/app.css"> --}}

    <link href="{{ asset('/plugin_tabullator/dist/css/tabulator.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/css/admin_custom.css">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

@stop


<style type="text/css">
    .loaders {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url('{{ asset('/gif/load.gif') }}') 50% 50% no-repeat rgb(249, 249, 249);
        opacity: .8;
    }

</style>


@section('content')

<div class="loaders d-none"></div>
    @include('partials.session-status')

    <div class="card card-cyan">
       
        <div class="card-header">
            <h4 class="card-title" style="margin: 0px 0px 0px 0px;"> <i class="fas fa-search"></i> Buscar Pedidos</h4>
        </div>
        <div class="card-body">
            <div class="row">

                <div class="col-md-5">
                    <label for="name_client">Buscar Pedido:</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-clipboard"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" placeholder="Buscar Pedido" id_pedido=0 id="textNumPedido"
                            disabled />
                        <div class="input-group-append">
                            <div class="input-group-text" type="button" id="btn-buscar-list-pedidos"><i class="fa fa-search"
                                    title="Buscar Todos los pedidos"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-5 ">
                    <label for="orderStatus">Estado de Pedido : </label>
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-sector"><i
                                    class="fa fa-exclamation-triangle"></i></span>
                        </div>
                        <select id="orderStatus" name="orderStatus" class="form-control">
                            <option value=0 disabled>------Seleccionar------</option>
                            {{-- @foreach ($orderStatus as $estado)
                                <option value="{{ $estado->codigo }}">{{ $estado->name }}</option>
                            @endforeach --}}
                        </select>

                    </div>
                </div>



                <div class="col-md-2 ">
                    <label for="orderStatus">Procesar </label>
                    <div class="form-group row ">
                        <form action="{{ route('orden.procesar.buscar') }}" id="form-filtrar-buscar-orden" method="POST">
                            <input type="hidden" name="_token" id="token_filtar_busqd" value="{{ csrf_token() }}">
                            <button class="btn btn-info " id="btn-buscar-filtro-orden" type="button"
                                title="Buscar Pedidos Filtrando"> <i class="fas fa-search"></i>
                                Buscar Pedido</button>
                        </form>
                    </div>
                </div>

            </div>

           

        </div>
        <!-- /.card-body -->
    </div>


    <div class="card card-cyan">

        <div class="card-header">
            <a href="#" class="btn btn-info">
                <i class="fas fa-plus-square"></i> Button
            </a>
        </div>

        <div class="card-body">

        </div>
    </div>
@stop

@section('js')

@stop