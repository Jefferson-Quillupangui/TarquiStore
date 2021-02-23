@extends('adminlte::page')

@section('title', 'Reportes')

@section('content_header')
    <h1><i class="fas fa-user-cog"></i>Reportes</h1>
@stop

@section('css')

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

        <form action="{{ route('reporteComprasCliente') }}" id="form-compras-por-cliente" class="d-none"></form>
        <form action="{{ route('reporteVentasPorVendedor') }}" id="form-vemtas-por-vendedor" class="d-none"></form>
        <form action="{{ route('reporteProductosVendidos') }}" id="form-productos-vendidos" class="d-none"></form>
        <div class="card-header">
            <h4 class="card-title" style="margin: 0px 0px 0px 0px;"><i class="fa fa-file"></i> Visualizacion de Reportes
            </h4>
        </div>

        <div class="card-body">

            <div class="row">
                <div class="col-md-5">
                    <label for="name_client">Reporte:</label>
                    <div class="input-group mb-3">
                        <select id="select-tipo-reporte" class="form-control">
                            <option value="0" disabled>------Seleccionar------</option>
                            <option value="AA">Compras por clientes</option>
                            <option value="AB">Ventas por vendedor</option>
                            <option value="AC">Listados de Productos Vendidos</option>
                            <option value="AD">Ventas Diarias</option>
                            <option value="AE">Ventas Por Categoria</option>
                            <option value="AF">Pedidos Entregados</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
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

                <div class="col-md-5">
                    <label for="name_client">Mes:</label>
                    <div class="input-group mb-3">
                        <select id="select-mes" class="form-control">
                            <option value="0" disabled>------Seleccionar------</option>
                            <option value="01">Enero</option>
                            <option value="02">Febrero</option>
                            <option value="03">Marzo</option>
                            <option value="04">Abril</option>
                            <option value="05">Mayo</option>
                            <option value="06">Junio</option>
                            <option value="07">Julio</option>
                            <option value="08">Agosto</option>
                            <option value="09">Septiembre</option>
                            <option value="10">Octubre</option>
                            <option value="11">Noviembre</option>
                            <option value="12">Diciembre</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-2 ">
                    <label for="orderStatus">Procesar </label>
                    <div class="form-group row ">
                        {{-- <form action="http://tarquistore.test/buscar_order" id="form-filtrar-buscar-orden" method="POST"> --}}
                        {{-- <input type="hidden" name="_token" id="token_filtar_busqd"
                            value="2lA8TptJKGUrgJWWvug3hAIatBvM7AtipNprWCgr"> --}}
                        <button class="btn btn-info " id="btn-buscar-filtro-reportes" type="button" title="Buscar"> <i
                                class="fas fa-search"></i>
                            Buscar</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="d-none" id="div-op-compras-clientes">
                <div class="row">
                    <div class="col-md-12">
                        <button id="download-reportes-xlsx" type="button" class="btn btn-success float-right"> <i
                                class="fas fa-excel"></i>Descargar Excel</button>
                        <button id="download-reportes-pdf" class="btn btn-danger float-right"><i class="fa fa-file-pdf-o"
                                aria-hidden="true"></i>Descargar PDF</button>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-12">
                        <div id="grid-table-compras-cliente"></div>
                    </div>
                </div>
            </div>

            <div class="d-none" id="div-op-ventas-por-vendedor">
                <div class="row">
                    <div class="col-md-12">

                        <button id="download-reportes_V_X_V-xlsx" type="button" class="btn btn-success float-right"> <i
                                class="fas fa-excel"></i>Descargar Excel</button>
                        <button id="download-reportes_V_X_V-pdf" class="btn btn-danger float-right"><i
                                class="fa fa-file-pdf-o" aria-hidden="true"></i>Descargar PDF</button>
                    </div>
                </div> <br>
                <div class="row">
                    <div class="col-md-12">
                        <div id="grid-table-ventas-por-vendedor"></div>
                    </div>
                </div>
            </div>

            <div class="d-none" id="div-op-lista-productos-vendidos">
                <div class="row">
                    <div class="col-md-12">

                        <button id="download-reportes_Lista_Product_Vendidos-xlsx" type="button"
                            class="btn btn-success float-right"> <i class="fas fa-excel"></i>Descargar Excel</button>
                        <button id="download-reportes_Lista_Product_Vendidos-pdf" class="btn btn-danger float-right"><i
                                class="fa fa-file-pdf-o" aria-hidden="true"></i>Descargar PDF</button>
                    </div>
                </div> <br>
                <div class="row">
                    <div class="col-md-12">
                        <div id="grid-table-lista-productos-vendidos"></div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    </div>
    {{-- <div class="card">

        <div class="card-header">
            <a href="#" class="btn btn-info">
                <i class="fas fa-plus-square"></i> Button
            </a>
        </div>

        <div class="card-body">

        <div class="container">
 <div class="row">
  <div class="col-md-10 col-md-offset-1">
   <div class="panel panel-default">
    <div class="panel-heading">Report</div>
    <div class="panel-body">
     <form class="form-horizontal" role="form" method="POST" action="/pruebaPdf">
      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                     <div class="form-group">
                         <div class="col-sm-offset-3 col-sm-5">
                             <button type="submit" class="btn btn-primary">Generate</button>
                         </div>
                     </div>
                 </form>
    </div>
   </div>
  </div>
 </div>
</div>

        </div>
    </div> --}}
@stop

@section('js')

    {{-- <script type="text/javascript" src="{{ asset('/plugin_tabullator/dist/js/tabulator.min.js') }}"></script> --}}
    <script type="text/javascript" src="https://oss.sheetjs.com/sheetjs/xlsx.full.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.0.5/jspdf.plugin.autotable.js"></script>
    <script type="text/javascript" src="{{ asset('js/adminlte/reportes/reportesGenerales.js') }}"></script>

@stop
