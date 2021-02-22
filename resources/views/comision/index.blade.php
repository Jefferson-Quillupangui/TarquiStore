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

    <div class="card card-cyan collapsed-card">
        <form action="{{ route('list_colaboradores_json') }}" id="form-buscar-colaboradores" class="d-none"></form>
        <form action="{{ route('comision.buscar.colaborador') }}" id="form-buscar-comision" class="d-none"></form>
        <div class="card-header">
            <h4 class="card-title" style="margin: 0px 0px 0px 0px;"> <i class="fas fa-search"></i> Consulta de comisión</h4>
          <div class="card-tools">
            <button type="button" class="btn btn-tool mt-0" data-card-widget="collapse" ><i class="fas fa-plus"></i></button>
          </div>
        </div>
        <div class="card-body">
            <div class="row">
    
                @can('Administrar pedidos')
                    <div class="col-md-5">
                        <label for="name_client">Buscar Colaboraderes:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-address-book"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" placeholder="Buscar Colaborador" id_colaborador=0
                                id="txtNombreColaborador" disabled />
                            <div class="input-group-append">
                                <div class="input-group-text" type="button" id="btn-buscar-list-colaboradores"><i
                                        class="fa fa-search" title="Buscar Colaboradores"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-md-5">
                        <label for="name_client">Buscar Colaboraderes:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-address-book"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" value={{ $name }} placeholder="Buscar Colaborador"
                                id_colaborador={{ auth()->user()->id }} id="txtNombreColaborador" disabled />
                            <div class="input-group-append">
                                <div class="input-group-text" type="button" id="btn-buscar-list-colaboradores____"><i
                                        class="fa fa-search" title="Buscar Colaboradores"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                @endcan
    
    
    
                <div class="col-md-5 ">
                    <label for="anio_order">Año : </label>
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-sector"><i
                                    class="fa fa-exclamation-triangle"></i></span>
                        </div>
                        <select id="anio_order" name="anio_order" class="form-control">
                            <option value=0 disabled>------Seleccionar------</option>
                            @foreach ($anios_obtenidos_orden as $estado)
                                <option value="{{ $estado->anio }}">{{ $estado->anio }}</option>
                            @endforeach
                        </select>
    
                    </div>
                </div>
    
    
    
                <div class="col-md-2 ">
                    <label for="orderStatus">Procesar </label>
                    <div class="form-group row ">
    
                        {{-- <input type="hidden" name="_token" id="token_buscar" value="{{ csrf_token() }}"> --}}
                        <button class="btn btn-info " id="btn-buscar-comision" type="button" title="Buscar Comision"> <i
                                class="fas fa-search"></i>
                            Buscar Comision</button>
                        </form>
                    </div>
                </div>
    
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    {{-- <button id="download-csv">Download CSV</button> --}}
                    {{-- <button id="download-json">Download JSON</button> --}}
                    <button id="download-xlsx" class="btn btn-success float-right"><i class="fa fa-file-excel-o"
                            aria-hidden="true"></i>Descargar Excel</button>
                    {{-- <button id="download-pdf">Download PDF</button> --}}
                    {{-- <button id="download-html">Download HTML</button> --}}
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div id="grid-table-comisiones-colaboradores"></div>
                </div>
            </div>
            <hr>
    
        </div>
      </div>    

      <div class="card card-cyan collapsed-card">
        <form action="{{ route('list_colaboradores_json') }}" id="form-buscar-colaboradores" class="d-none"></form>
        <form action="{{ route('comision.buscar.colaborador') }}" id="form-buscar-comision" class="d-none"></form>
        <div class="card-header">
            <h4 class="card-title" style="margin: 0px 0px 0px 0px;"> <i class="fas fa-search"></i> Consulta de comisión general</h4>
          <div class="card-tools">
            <button type="button" class="btn btn-tool mt-0" data-card-widget="collapse" ><i class="fas fa-plus"></i></button>
          </div>
        </div>
        <div class="card-body">
            <div class="row">
    
                <!-- Contenido -->

        </div>
      </div>    
     
      
      <!-- Modal Buscar Colaboradores -->
    <div class="modal fade" id="modal-buscarColaboradores" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Colaboradores</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div id="table-list-colaboradores"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btn-cancelar-modal-colaboradores" class="btn btn-danger">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="card card-cyan">

        <div class="card-header">
            <a href="#" class="btn btn-info">
                <i class="fas fa-plus-square"></i> Button
            </a>
        </div>

        <div class="card-body">

        </div>
    </div> --}}
@stop

@section('js')
    <script type="text/javascript" src="{{ asset('/plugin_tabullator/dist/js/tabulator.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/adminlte/comisiones/comisionesOrdenes.js') }}"></script>
    <script type="text/javascript" src="https://oss.sheetjs.com/sheetjs/xlsx.full.min.js"></script>

@stop
