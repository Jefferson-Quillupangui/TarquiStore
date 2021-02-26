<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reportes Por Ventas Por Categoria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
</head>

<body>

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>Codigo Categoria</th>
                <th>Nombre Categoria</th>
                <th>Cantidad Productos</th>
                <th>Monto Total</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item->codigo_categoria }} </td>
                    <td>{{ $item->nombre_categoria }}</td>
                    <td>{{ $item->cantidad_productos }}</td>
                    <td>{{ $item->monto_total }}</td>

                </tr>
            @endforeach
        </tbody>
    </table>


</body>

</html>
