@extends('adminlte::page')

@section('title', 'TarquiStore')

@section('css')
    <link href="{{ asset('/plugin_tabullator/dist/css/tabulator.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/css/admin_custom.css">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    {{-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/datepicker/bootstrap-datepicker.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('/datepicker/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> --}}




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



@section('content_header')

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
                        <input type="search" class="form-control" placeholder="Buscar Pedido" aria-label="Search"
                            aria-describedby="search-addon" id_orden=0 id="textbuscarPedido" disabled />
                        <div class="input-group-append">
                            <div class="input-group-text" type="button" id="btn-buscar-pedido"><i class="fa fa-search"></i>
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
                        @can('Administrar pedidos')
                            <select id="orderStatus" name="orderStatus" class="form-control" disabled>
                                <option value=0 disabled>------Seleccionar------</option>
                                @foreach ($orderStatus as $estado)
                                    <option value="{{ $estado->codigo }}">{{ $estado->name }}</option>
                                    {{-- <option selected="true" value="{{$sector->codigo}}"> {{$sector->name}} </option> --}}
                                @endforeach
                            </select>
                        @else
                            <select id="orderStatus" name="orderStatus" class="form-control" disabled>
                                <option value=0 disabled>------Seleccionar------</option>
                                @foreach ($orderStatus as $estado)
                                    @if ($estado->codigo != 'OE')
                                        <option value="{{ $estado->codigo }}">{{ $estado->name }}</option>
                                    @endif

                                    {{-- <option value="{{$sector->codigo}}"> {{$sector->name}} </option> --}}
                                @endforeach
                            </select>

                        @endcan
                    </div>
                </div>



                <div class="col-md-2 ">
                    <label for="orderStatus">Procesar </label>
                    <div class="form-group row ">
                        <form action="{{ route('orden.procesar') }}" id="form-procesar-orden" method="POST">
                            <input type="hidden" name="_token" id="token_procesar" value="{{ csrf_token() }}">
                            <button class="btn btn-info " id="btn-procesar-orden" type="button"> <i class="fas fa-save"></i>
                                Procesar Orden</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <!-- /.card-body -->
    </div>



    {{-- <div class="row mb-4">
        <div class="col-md-6">
            <h1> <i class="fab fa-creative-commons-share"></i> Registrar pedido</h1>
        </div>

       
    </div> --}}





@stop

@section('content')
    <div class="loaders d-none"></div>



    <div class="card card-cyan">
        <div class="card-header ">
            <h4 class="card-title" style="margin: 0px 0px 0px 0px;"> <i class="far fa-plus-square"></i> Registrar pedido
            </h4>
        </div>

        <div class="card-body">
            <form action="{{ route('clientes.lista') }}" id="form-listarclientes"></form>
            <form action="{{ route('productos.lista') }}" id="form-listarproductos"></form>
            <form action="{{ route('orders.lista') }}" id="form-lista-pedidos"></form>
            <form action="{{ route('orders.detalle') }}" id="form-detalle-pedidos"></form>
            <form action="{{ route('stock.product') }}" id="form-stock-productos"></form>
            <div class="form-group">

                <div class="row">

                    <div class="input-group mb-3">
                        ID :<input type="text" id="txt_id_cab_orden" name="txt_id_cab_orden" value=0 disabled>
                    </div>
                </div>

                <div class="row">

                    {{-- <div class="input-group">
                        
                      </div> --}}

                    <div class="col-md-6">
                        <label for="name_client">Cliente:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-user-plus"></i>
                                </span>
                            </div>
                            <input type="search" class="form-control" placeholder="Buscar cliente" aria-label="Search"
                                aria-describedby="search-addon" id="textbuscarcliente" codigocliente=0 disabled />
                            <div class="input-group-append">
                                <div class="input-group-text" type="button" id="btn-buscarpersona"><i class="fa fa-search"
                                        title="Buscar Clientes"></i></div>
                            </div>
                            {{-- <input type="search" class="form-control rounded" placeholder="Buscar cliente"
                                aria-label="Search" aria-describedby="search-addon" id="textbuscarcliente" codigocliente=0
                                disabled />
                            <button type="button" id="btn-buscarpersona" class="btn btn-outline-primary">Buscar </button> --}}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="identification">Identificación:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-id-card"></i></span>
                            </div>
                            {!! Form::text('identification', null, ['class' => 'form-control' .
                            ($errors->has('identification') ? ' is-invalid' : ''), 'placeholder' => 'Identificación', 'id'
                            => 'textidentification', 'disabled']) !!}
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

                                {!! Form::text('phone1', null, [
                                'class' =>
                                'form-control' .
                                ($errors->has('phone1')
                                ? '
                                is-invalid'
                                : ''),
                                'placeholder' => 'Telefono 1',
                                'id' => 'textphone1',
                                'disabled',
                                ]) !!}

                                {!! Form::text('phone2', null, [
                                'class' =>
                                'form-control' .
                                ($errors->has('phone2')
                                ? '
                                is-invalid'
                                : ''),
                                'placeholder' => 'Telefono 2',
                                'id' => 'textphone2',
                                'disabled',
                                ]) !!}


                            </div>
                        </div>
                        {{-- <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-user-plus"></i>
                                </span>
                            </div>
                            <input type="search" class="form-control" placeholder="Buscar cliente" aria-label="Search"
                                aria-describedby="search-addon" id="textbuscarcliente" codigocliente=0 disabled />
                            <div class="input-group-append">
                                <div class="input-group-text" type="button" id="btn-buscarpersona"><i
                                        class="fa fa-search"></i></div>
                            </div>
                        </div> --}}
                    </div>
                    <div class="col-md-6">
                        <label for="email">Correo:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope"
                                        aria-hidden="true"></i></span>
                            </div>
                            {!! Form::text('email', null, [
                            'class' =>
                            'form-control' .
                            ($errors->has('email')
                            ? '
                            is-invalid'
                            : ''),
                            'placeholder' => 'Email',
                            'id' => 'textEmail',
                            'disabled',
                            ]) !!}
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

                                <input type="date" class="form-control" id="fechaActual" value="">

                                <div class="input-group-append">
                                    <input type="time" class="form-control" id="horaActual" value="">
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
                            {{-- <h1> {{ auth()->user()->name }} </h1> --}}
                            <input id="colaborador" type="text" class="form-control" placeholder="Colaborador"
                                value={{ $name }} disabled id_colaborador={{ auth()->user()->id }}>

                            {{-- <input type="text" name="sexo" id="varon" value={{ $name }}> --}}
                            {{-- {!!  Form::text('Colaborador', "{{$name}}", ['class' => 'form-control' . ($errors->has('txtColaborador') ? ' is-invalid' : ''), 'placeholder' => 'Colaborador', 'id' => 'txtColaborador', 'disabled']) !!} --}}
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="sectors">Sector:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-sector"><i class="far fa-list-alt"></i></span>
                            </div>
                            <select id="sectors" name="sectors" class="form-control">
                                <option value=0 disabled>------Seleccionar------</option>
                                @foreach ($sectors as $sector)
                                    <option value="{{ $sector->codigo }}">{{ $sector->name }}</option>
                                    {{-- <option value="{{$sector->codigo}}"> {{$sector->name}} </option> --}}
                                @endforeach
                            </select>
                            {{-- {!!  Form::select('sectors', $sectors, 0, ['class' => 'custom-select']) !!} --}}
                            @error('sectors')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="city">Ciudad:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="far fa-list-alt"></i></span>
                            </div>
                            <select id="city" name="city" class="form-control">
                                <option value=0 disabled>------Seleccionar------</option>
                                @foreach ($citySale as $cat)
                                    <option value="{{ $cat->codigo }}">{{ $cat->name }}</option>
                                    {{-- <option value="{{$sector->codigo}}"> {{$sector->name}} </option> --}}
                                @endforeach
                            </select>
                            {{-- {!!  Form::select('category', $category, 0, ['class' => 'custom-select']) !!} --}}
                            @error('city')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
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
                                {!! Form::textarea('address_delivery', null, [
                                'class' => 'form-control' . ($errors->has('address_delivery') ? ' is-invalid' : ''),
                                'placeholder' => 'Ingrese direccion ',
                                'rows' => '2',
                                'id' => 'textaddressdelivery',
                                'spellcheck' => 'false',
                                ]) !!}
                            </div>
                            @error('address_delivery')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="textObservacion">Observacion:</label>
                        <div class="input-group mb-3 ">
                            <div class="input-group resize:none">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-sticky-note"></i></span>
                                </div>
                                {!! Form::textarea('textObservacion', null, [
                                'class' => 'form-control' . ($errors->has('textObservacion') ? ' is-invalid' : ''),
                                'placeholder' => 'Ingrese observacion',
                                'rows' => '2',
                                'id' => 'textObservacion',
                                'spellcheck' => 'false',
                                ]) !!}
                            </div>
                            @error('textObservacion')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                </div>


                <hr>
                <div class="row">
                    <div class="col-md-10">
                        <p><Strong>Detalle del Pedido </Strong></p>
                    </div>
                    <div class="col-md-2">
                        <button type="button" id="btn-modal-buscar-producto" class="btn btn-success"
                            title="Agregar un Producto">
                            <i class="fas fa-plus"></i> Agregar
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div id="grid-table-detalle-pedido"></div>
                    </div>
                </div>
                <hr>


                <div class="row">
                    <div class="col-sm-7">

                        {{-- <div class="form-group row error-group">
                            <label for="cmb-sustento" class="col-sm-4 control-label ">Sus. Tributario<i class="obligatorio">*</i></label>
                            <div class="col-sm-8">
                                <select class="combosustentotributario_fact select2-hidden-accessible" id="metodo" style="width: 100%" data-select2-id="metodo" tabindex="-1" aria-hidden="true"><option value="01" data-select2-id="10">CREDITO TRIBUTARIO PARA DECLARACION DE IVA</option></select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="11" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-metodo-container"><span class="select2-selection__rendered" id="select2-metodo-container" role="textbox" aria-readonly="true" title="CREDITO TRIBUTARIO PARA DECLARACION DE IVA">CREDITO TRIBUTARIO PARA DECLARACION DE IVA</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                            </div>
                        </div> --}}
                    </div>

                    <div class="col-sm-5">
                        <div class="form-group row ">
                            <label for="txtTotalOrden" class="col-sm-4 control-label ">Total Orden:</label>
                            <div class="col-sm-8">
                                <input type="text" value="0.00" class="form-control txtTotalOrden text-right"
                                    id="txtTotalOrden" name="txtTotalOrden" placeholder="" disabled="disabled">
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label for="txt_totalComision" class="col-sm-4 control-label ">Total Comision:</label>
                            <div class="col-sm-8">
                                <input type="text" value="0.00" class="form-control txt_totalComision text-right"
                                    id="txt_totalComision" name="txt_totalComision" placeholder="" disabled="disabled">
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-10"></div>
                    <div class="col-md-2 ">
                        <div class="form-group row ">
                            <form action="{{ route('orden.create') }}" id="form-crearorden" method="POST">
                                {{-- @csrf --}}
                                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

                                {{-- <a class="btn btn-danger" id="btn-generarorden">
                                    <i class="fas fa-save"></i> Guardar
                                </a> --}}
                                <button class="btn btn-info " id="btn-generarorden" type="button"> <i
                                        class="fas fa-save"></i> Guardar</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            {{-- <div class="row">
                <div class="col-md-5">
                    <label for="price">Total Orden:</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="far fa-keyboard"></i></span>
                        </div>
                        {!!  Form::number('price', null, [
                            'class' =>
                                'form-control' .
                                ($errors->has('price')
                                    ? '
                        is-invalid'
                                    : ''),
                            'placeholder' => 'Precio de venta del producto',
                            'step' => 'any',
                        ]) !!}
                        @error('price')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <label for="comission">Total Comision:</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="far fa-keyboard"></i></i></span>
                        </div>
                        {!!  Form::number('comission', null, [
                            'class' =>
                                'form-control' .
                                ($errors->has('comission')
                                    ? '
                        is-invalid'
                                    : ''),
                            'placeholder' => 'Valor de comisión del producto',
                            'step' => 'any',
                        ]) !!}
                        @error('comission')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

            </div> --}}
            {{-- <div class="row">
                <div class="col-md-5">
                    <label for="discount">Observacion:</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="far fa-keyboard"></i></span>
                        </div>
                        {!!  Form::number('discount', null, [
                            'class' =>
                                'form-control' .
                                ($errors->has('discount')
                                    ? '
                        is-invalid'
                                    : ''),
                            'placeholder' => 'Valor de descuento del producto',
                            'step' => 'any',
                        ]) !!}
                        @error('discount')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
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
                        {!!  Form::select('category', $category, 0, ['class' => 'custom-select']) !!}
                        @error('category')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div> --}}
            {{-- <div class="row">
                <div class="col-md-5">
                    <form action="{{ route('orden.create') }}" id="form-crearorden" method="POST">
                         @csrf 
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

                        <button class="btn btn-danger" id="btn-generarorden" type="button">Accion</button>
                    </form>
                </div>
            </div> --}}

        </div>

    </div>
    </div>




    {{-- @include('pedido.ordertable') --}}

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
                        <div id="clientes-table"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btn-cancelar-pedido" class="btn btn-danger">Cancelar</button>
                    {{-- <button type="button" id="btn-guardar-estb" class="btn btn-success">Guardar</button> --}}
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Buscar Producto -->
    <div class="modal fade" id="modal-buscarProducto" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Lista de Productos</h5>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal"
                     aria-label="Close"></button> --}}
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div id="producto-table"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btn-cancelar-producto" class="btn btn-danger">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Buscar Pedidos -->
    <div class="modal fade" id="modal-buscarPedido" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Lista de Pedidos</h5>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal"
                  aria-label="Close"></button> --}}
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div id="table-lista-ordenes"></div>
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
    <script type="text/javascript" src="{{ asset('js/adminlte/pedidos/pedidos.js?vs=08') }}"></script>

@stop
