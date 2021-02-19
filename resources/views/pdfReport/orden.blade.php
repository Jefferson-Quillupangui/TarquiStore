<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte Orden</title>
</head>

<body>
    ID : {{ $orders->id }}
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
    </table>
</body>

</html>
