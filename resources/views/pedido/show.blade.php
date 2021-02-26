@extends('adminlte::page')

@section('title', 'TarquiStore')

@section('content_header')
    <h1><i class="fas fa-th-large"></i> Revisión de pedidos</h1>
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
        <form action="{{ route('list_orders_json') }}" id="form-revision-lista-pedidos" class="d-none"></form>
        <form action="{{ route('lista.orders.detalle') }}" id="form-detalle-lista-pedidos" class="d-none"></form>
        <form action="{{ route('list_orders_auditoria_json') }}" id="form-auditoria-orden" class="d-none"></form>
        <div class="card-header">
            <h4 class="card-title" style="margin: 0px 0px 0px 0px;"><i class="fas fa-search-plus"></i> Busqueda general</h4>
            <div class="card-tools">
                <button type="button" class="btn btn-tool mt-0" data-card-widget="collapse"><i
                        class="fas fa-plus"></i></button>
            </div>
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

            </div>
        </div>
    </div>

    <div class="card card-cyan collapsed-card">
        <div class="card-header">
            <h4 class="card-title" style="margin: 0px 0px 0px 0px;"> <i class="fas fa-search"></i> Busqueda por fecha</h4>
            <div class="card-tools">
                <button type="button" class="btn btn-tool mt-0" data-card-widget="collapse"><i
                        class="fas fa-plus"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">

                <div class='col-sm-3'>
                    <label for="identification">Fecha Desde:</label>
                    <div class="input-group mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-circle"></i>
                                </span>
                            </div>

                            <input type="date" class="form-control" id="fechaDesde" value="">
                        </div>
                    </div>
                </div>

                <div class='col-sm-3'>
                    <label for="identification">Fecha Hasta:</label>
                    <div class="input-group mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-circle"></i>
                                </span>
                            </div>

                            <input type="date" class="form-control" id="fechaHasta" value="">
                        </div>
                    </div>
                </div>

                <div class="col-md-3 ">
                    <label for="orderStatus">Estado de Pedido : </label>
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-sector"><i
                                    class="fa fa-exclamation-triangle"></i></span>
                        </div>
                        <select id="orderStatus" name="orderStatus" class="form-control">
                            <option value=0 disabled>------Seleccionar------</option>
                            @foreach ($orderStatus as $estado)
                                <option value="{{ $estado->codigo }}">{{ $estado->name }}</option>
                            @endforeach
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
    </div>

    <div class="card card-cyan">
        {{-- <input type="hidden" name="_token" id="token_orden_busqd" value="{{ csrf_token() }}">
        <form action="{{ route('reporte.orden.datos') }}" id="form-datos-orden" class="d-none"></form> --}}
        <div class="card-header">
            <h4 class="card-title" style="margin: 6px 0px 0px 0px;"><i class="fa fa-file"></i> Visualizacion Orden</h4>




            {{-- <a type="button" href="{{ route('reporte.orden.datos', ['id' => 0]) }}" class="btn btn-danger float-right"
                target="_blank" title="Pdf Orden" id="generar-pdf-orden"><i class="far fa-file-pdf"></i></a> --}}


            {{-- href="{{url('reporteFecha',array('fechaMenor'=>$fechaMenor,'fechaMayor'=>$fechaMayor))}}" --}}
            {{-- <button type="button" id="generar-pdf-orden" class="btn btn-default float-right" title="Pdf Orden"><i class="far fa-file-pdf"></i></button> --}}

        </div>

        <div class="card-body">

            {{-- <div class="row">

                <div class="input-group mb-3">
                    ID :<input type="text" id="txt_id_cab_orden" name="txt_id_cab_orden" value=0 disabled>
                </div>
            </div> --}}

            <div class="row">
                <div class="col-md-6">
                    <label for="name_client">Estado Orden:</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-eject"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" placeholder="Estado" aria-label="Search"
                            aria-describedby="search-addon" id="txtEstadoOrden" codigocliente=0 disabled />

                    </div>
                </div>
                <div class="col-md-6">
                    <form action="{{ route('reporte_post.orden.datos') }}" method="POST">
                        @csrf
                        <input class="d-none" type="text" id="txt_id_cab_orden" name="txt_id_cab_orden" value=0>

                        <button disabled class="btn btn-danger float-right" id="generar-pdf-orden" type="submit"
                            title="Generar Pdf">
                            <i class="fas fa-file-code-o"></i>Generar Pdf
                        </button>

                    </form>
                    {{-- <label for="identification">Identificación:</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-id-card"></i></span>
                        </div>
                        <input class="form-control" placeholder="Identificación" id="txtIdentificacion" disabled=""
                            name="identification" type="text">
                    </div> --}}
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label for="name_client">Cliente:</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-user-plus"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" placeholder="Cliente" aria-label="Search"
                            aria-describedby="search-addon" id="txtCliente" codigocliente=0 disabled />

                    </div>
                </div>
                <div class="col-md-6">
                    <label for="identification">Identificación:</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-id-card"></i></span>
                        </div>
                        <input class="form-control" placeholder="Identificación" id="txtIdentificacion" disabled=""
                            name="identification" type="text">
                    </div>
                </div>
            </div>


            <div class="row">

                <div class="col-md-6">
                    <label for="phone1">Telefonos:</label>
                    <div class="input-group mb-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-phone"></i>
                                </span>
                            </div>

                            <input class="form-control" placeholder="Telefono 1" id="txtPhone1" disabled="" name="phone1"
                                type="text">

                            <input class="form-control" placeholder="Telefono 2" id="txtPhone2" disabled="" name="phone2"
                                type="text">


                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="email">Correo:</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope"
                                    aria-hidden="true"></i></span>
                        </div>
                        <input class="form-control" placeholder="Email" id="txtEmail" disabled="" name="email" type="text">
                    </div>
                </div>
            </div>


            <div class="row">
                <div class='col-sm-6'>
                    <label for="identification">Fecha/Hora:</label>
                    <div class="input-group mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-circle"></i>
                                </span>
                            </div>

                            <input type="date" class="form-control" id="fechaActual" disabled="" value="">

                            <div class="input-group-append">
                                <input type="time" class="form-control" id="horaActual" disabled="" value="">
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <label for="txtColaborador">Colaborador:</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                        </div>

                        <input id="colaborador" type="text" disabled="" class="form-control" placeholder="Colaborador"
                            value="">
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-6">
                    <label for="sectors">Sector:</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="far fa-list-alt"
                                    aria-hidden="true"></i></span>
                        </div>
                        <input class="form-control" placeholder="Sector" id="txtSector" disabled="" name="email"
                            type="text">
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="city">Ciudad:</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="far fa-list-alt"
                                    aria-hidden="true"></i></span>
                        </div>
                        <input class="form-control" placeholder="Ciudad" id="txtCiudad" disabled="" name="email"
                            type="text">
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-6">
                    <label for="address_delivery">Dirección/Ubicación:</label>
                    <div class="input-group mb-3 ">
                        <div class="input-group resize:none">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-map-marker"></i></span>
                            </div>
                            <textarea class="form-control" placeholder="Ingrese direccion " disabled="" rows="2"
                                id="txtDireccion" spellcheck="false" name="address_delivery" cols="50"></textarea>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="textObservacion">Observacion:</label>
                    <div class="input-group mb-3 ">
                        <div class="input-group resize:none">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-sticky-note"></i></span>
                            </div>
                            <textarea class="form-control" placeholder="Ingrese observacion" disabled="" rows="2"
                                id="txtObservacion" spellcheck="false" name="textObservacion" cols="50"></textarea>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-6">
                    <label for="sectors">Total Orden:</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="far fa-list-alt"
                                    aria-hidden="true"></i></span>
                        </div>
                        <input class="form-control" placeholder="Total Orden" id="txtTotalOrden" disabled="" name="email"
                            type="text">
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="city">Total Comision:</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="far fa-list-alt"
                                    aria-hidden="true"></i></span>
                        </div>
                        <input class="form-control" placeholder="Total Comision" id="txtTotalComision" disabled=""
                            name="email" type="text">
                    </div>
                </div>

            </div>

            <hr>
            <div class="row">
                <div class="col-md-10">
                    <p><Strong>Detalle del Pedido </Strong></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div id="grid-table-list-detalle-pedido"></div>
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-md-10">
                    <p><Strong>Registro de Movimientos</Strong></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div id="grid-table-auditoria-estados"></div>
                </div>
            </div>
            <hr>


        </div>

    </div>
    </div>




    <!-- Modal Buscar Pedidos -->
    <div class="modal fade" id="modal-buscarRevisionPedido" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Lista de Pedidos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div id="table-reviosion-list-ordenes"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btn-cancelar-modal-pedido" class="btn btn-danger">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
@stop



@section('js')
    <script type="text/javascript" src="{{ asset('/plugin_tabullator/dist/js/tabulator.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/adminlte/pedidos/listaPedidos.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/adminlte/reportes/reportesPdf.js') }}"></script>

@stop
