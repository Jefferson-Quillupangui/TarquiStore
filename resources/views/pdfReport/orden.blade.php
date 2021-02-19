<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte Orden</title>

    <style type="text/css" media="screen">
        html {
            font-family: sans-serif;
            line-height: 1.15;
            margin: 0;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: left;
            background-color: #fff;
            font-size: 10px;
            margin: 36pt;
        }
        h4 {
            margin-top: 0;
            margin-bottom: 0.5rem;
        }
        p {
            margin-top: 0;
            margin-bottom: 1rem;
        }
        strong {
            font-weight: bolder;
        }
        img {
            vertical-align: middle;
            border-style: none;
        }
        table {
            border-collapse: collapse;
        }
        th {
            text-align: inherit;
        }
        h4, .h4 {
            margin-bottom: 0.5rem;
            font-weight: 500;
            line-height: 1.2;
        }
        h4, .h4 {
            font-size: 1.5rem;
        }
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }
        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }
        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }
        .table tbody + tbody {
            border-top: 2px solid #dee2e6;
        }
        .mt-5 {
            margin-top: 3rem !important;
        }
        .pr-0,
        .px-0 {
            padding-right: 0 !important;
        }
        .pl-0,
        .px-0 {
            padding-left: 0 !important;
        }
        .text-right {
            text-align: right !important;
        }
        .text-center {
            text-align: center !important;
        }
        .text-uppercase {
            text-transform: uppercase !important;
        }
        * {
            font-family: "DejaVu Sans";
        }
        body, h1, h2, h3, h4, h5, h6, table, th, tr, td, p, div {
            line-height: 1.1;
        }
        .party-header {
            font-size: 1.5rem;
            font-weight: 400;
        }
        .total-amount {
            font-size: 12px;
            font-weight: 700;
        }
        .border-0 {
            border: none !important;
        }
        table#tcaborder td
        {
            border: none !important;
        }
        table#tcliente th
        {
            border: none !important;
        }
        #tdetalle th
        {
            border: none !important;
        }
    </style>

</head>

<body>
    {{-- ID : {{ $orders->id }}
    <br>
    Estado Orden:{{ $orders->nombre_estado_ord }}
    <br>
    Cliente:{{ $orders->nombre_cliente }}
    <br>
    Identificación:{{ $orders->identification }}
    <br>
    Telefonos:{{ $orders->phone1 }}/{{ $orders->phone2 }}
    <br>
    Correo:{{ $orders->email }}
    <br>
    Fecha/Hora:{{ $orders->delivery_date }}/{{ $orders->delivery_time }}
    <br>
    Colaborador:{{ $orders->nombre_usuario }}
    <br>
    Sector:{{ $orders->nombre_sector }}
    <br>
    Ciudad:{{ $orders->nombre_ciudad }}
    <br>
    Dirección/Ubicación:{{ $orders->delivery_address }}
    <br>
    Observacion:{{ $orders->observation }}
    <br>
    Total Orden:{{ $orders->total_order }}
    <br>
    Total Comision:{{ $orders->total_comission }}
    <br>
    <hr>

    <table border="1">
        <thead>
            <tr>
                <th>Codigo Producto</th>
                <th>Nombre Producto</th>
                <th>Cantidad</th>
                <th>PVP Unitario</th>
                <th>% Descuento</th>
                <td>Descuento</td>
                <td>Comision</td>
                <td>Total Comision</td>
                <td>Total</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($detalle_orders as $item)
                <tr>
                    <td>{{ $item->product_id }} </td>
                    <td>{{ $item->name_product }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->discount_porcentage }}</td>
                    <td>{{ $item->price_discount }}</td>
                    <td>{{ $item->comission }}</td>
                    <td>{{ $item->total_comission }}</td>
                    <td>{{ $item->total_line }}</td>
                </tr>
            @endforeach
        </tbody>
    </table> --}}

<div>
    <table class="table mt-2 border-0" id="tcaborder" >
        <tbody>
            <tr>
                <td>
                    <div class="row">
                        <div class="col-xs-7">
                            <img src="{{ asset('/gif/logf.png') }}"><br>
                            {{-- <h4>Tarqui Store</h4> --}}
                            R.U.C 1312845025001<br>
                            Cooperativa Quisquis PB Solar 02 y manzana 50<br>
                            Ecuador, Guayaquil<br>
                            T: (042) 198437 <br>
                            E: tarqui.soporte@gmail.com <br>
                            <br>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="table mt-1 border-0" id="tcaborder" >
        <tbody style="border: none;">
            <tr>
                <td class="border-0 pl-0" width="70%">
                    <h4 class="text-uppercase">
                        <strong>Orden de venta <br>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            No. {{ str_pad($orders->id, 6, "0", STR_PAD_LEFT) }}</strong>
                    </h4>
                </td>
                <td class="border-0 pl-0">
                    <p>Fecha de orden:<strong> {{$orders->delivery_date}}</strong></p>
                    <p>Vendedor:<strong> {{ $orders->nombre_usuario }}</strong></p>
                    <p>Estado:<strong> {{ $orders->nombre_estado_ord }}</strong></p>
                </td>
            </tr>
        </tbody>
    </table>
{{-- CLIENTE --}}
<table class="table mt-1 border-0" id="tcliente">
        <thead>
            <tr>
                <th class="border-0 pl-0 party-header" width="48.5%">
                    Cliente
                </th>
                {{-- <th class="border-0" width="25%"></th> --}}
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="px-0">
                    {{-- <div class="col-xs-7"> --}}
                        <p style="line-height: 50%"><strong>{{$orders->nombre_cliente}}</strong></p>
                        <p style="line-height: 50%">Identificación: {{ $orders->identification }}</p>
                        <p style="line-height: 50%">Ciudad: {{ $orders->nombre_ciudad }}</p> 
                        <p style="line-height: 50%">Dirección: {{ $orders->delivery_address }}</p> 
                        <p style="line-height: 50%">Contacto: {{ $orders->phone1 }}/{{ $orders->phone2 }}</p>
                        <p style="line-height: 50%">Email: {{ $orders->email }}</p>
                    {{-- </div> --}}
                </td>
            </tr>
        </tbody>
</table>

 {{-- DETALLE ORDEN --}}
 <table class="table">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th class="text-right pr-0">Precio Unitario</th>
                    <th class="text-right pr-0">Porcentaje Descto.</th>
                    <th class="text-right pr-0">Precio Descto.</th>
                    <th class="text-right pr-0">Comision</th>
                    <th class="text-right pr-0">Subtotal Comision</th>
                    <th class="text-right pr-0">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($detalle_orders as $item)
                <tr>
                    <td>{{ str_pad($item->product_id, 4, "0", STR_PAD_LEFT) }} </td>
                    <td>{{ $item->name_product }}</td>
                    <td class="text-center border-0">{{ $item->quantity }}</td>
                    <td class="text-right pr-0">{{ $item->price }}</td>
                    <td class="text-right pr-0">{{ $item->discount_porcentage }}%</td>
                    <td class="text-right pr-0">{{ $item->price_discount }}</td>
                    <td class="text-right pr-0">{{ $item->comission }}</td>
                    <td class="text-right pr-0">{{ $item->total_comission }}</td>
                    <td class="text-right pr-0">{{ $item->total_line }}</td>
                </tr>
            @endforeach
            </tbody>
                    {{-- Totales --}}
                    <tr>
                    <td colspan="6" class="border-0"></td>
                    <td colspan="2" class="text-right pl-0"><strong>Total orden:</strong></td>
                    <td class="text-right pr-0">
                        {{ $orders->total_order }}
                    </td>
                </tr>
                <tr>
                    <td colspan="6" class="border-0"></td>
                    <td colspan="2" class="text-right pl-0"><strong> Total comisión:</strong></td>
                    <td class="text-right pr-0">
                            {{ $orders->total_comission }}
                    </td>
                </tr>
        </table>
        
        @if($orders->observation!="-")
        <p>Observación: <strong>{{ $orders->observation }}</strong></p>
        @endif

</body>

</html>
