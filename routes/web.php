<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\Pedidos\PedidosController;
use App\Http\Controllers\Pedidos\ListaPedidosController;
use App\Http\Controllers\Reportes\ReportesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SectorsController;
use App\Http\Controllers\StatusOrderController;
use App\Http\Controllers\TypesIdentificationController;
use App\Http\Controllers\ClientController;

use PHPJasper\PHPJasper; 




Route::get('/compilarReporte', function () {
    $input = base_path() .
    '/vendor/geekcom/phpjasper/examples/hello_world.jrxml';

    $jasper = new PHPJasper;
    $jasper->compile($input)->execute();

    return response()->json([
        'status' => 'ok',
        'msj' => '¡Reporte compilado!'
    ]);
});




Route::get('/reporte', function () {
    $input = base_path() .
    '/vendor/geekcom/phpjasper/examples/hello_world.jasper';
    $output = base_path() .
    '/vendor/geekcom/phpjasper/examples';
    $options = [
        'format' => ['pdf']
    ];

    $jasper = new PHPJasper;

    $jasper->process(
        $input,
        $output,
        $options
    )->execute();

    $pathToFile = base_path() .
    '/vendor/geekcom/phpjasper/examples/hello_world.pdf';
    return response()->file($pathToFile);
});


Route::get('/listarParametrosReporte', function () {
    $input = base_path() .
    '/vendor/geekcom/phpjasper/examples/hello_world_params.jrxml';

    $jasper = new PHPJasper;
    $output = $jasper->listParameters($input)->execute();

    return response()->json([
        'status' => 'ok',
        'parms' => $output
    ]);
});


Route::get('/compilarReporteParametros', function () {
    $input = base_path() .
    '/vendor/geekcom/phpjasper/examples/hello_world_params.jrxml';

    $jasper = new PHPJasper;
    $jasper->compile($input)->execute();

    return response()->json([
        'status' => 'ok',
        'msj' => '¡Reporte compilado!'
    ]);
});

Route::get('/reporteParametros', function () {
    $input = base_path() .
    '/vendor/geekcom/phpjasper/examples/hello_world_params.jasper';
    $output = base_path() .
    '/vendor/geekcom/phpjasper/examples';
    $options = [
        'format' => ['pdf'],
        'params' => [
            'myInt' => 7,
            'myDate' => date('y-m-d'),
            'myImage' => base_path() .
            '/vendor/geekcom/phpjasper/examples/jasperreports_logo.png',
            'myString' => 'Hola Mundo!'
        ]
    ];

    $jasper = new PHPJasper;

    // $jasper->process(
    //     $input,
    //     $output,
    //     $options
    // )->execute();

    // $pathToFile = base_path() .
    // '/vendor/geekcom/phpjasper/examples/hello_world_params.pdf';
    // return response()->file($pathToFile);

        // Depuración de errores
        dd($jasper->process(
            $input,
            $output,
            $options
        )->output());
});
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');//->middleware('verified');
//->middleware('verified');

Route::get('/dash', function () {
    return view('dash.index');
})->name('dashboard');

//Auth::routes(['verify' => true]);
//Categorias
Route::resource('categories',CategoryController::class)
    ->except(['show'])
    ->names('categories');
//Productos
Route::resource('products',ProductController::class)->names('products');
//Pedidos-Registro pedidos
Route::get('create_orders',  [PedidosController::class, 'index' ])->name('orders');
Route::get('list_clients', [PedidosController::class, 'listaClientes_json' ])->name('clientes.lista');
Route::get('list_products', [PedidosController::class, 'listaProductos_json' ])->name('productos.lista');
Route::get('lista_orders', [PedidosController::class, 'listaOrders_json' ])->name('orders.lista');
Route::get('detalle_orders', [PedidosController::class, 'detalleOrders_json' ])->name('orders.detalle');
Route::get('stock_product', [PedidosController::class, 'stock_product_json' ])->name('stock.product');
Route::post('generate_order', [PedidosController::class, 'createOrden' ])->name('orden.create');
Route::post('procesar_order', [PedidosController::class, 'ProcesarOrden' ])->name('orden.procesar');
//Ciudades
Route::resource('cities', CityController::class)
    ->except(['show'])
    ->names('ciudades');
//Sectores
Route::resource('sectors', SectorsController::class)
    ->except(['show'])
    ->names('sectors');
//Estados de orden
Route::resource( 'status_order', StatusOrderController::class)
    ->except(['show'])
    ->names('status_order');
//Tipos de identificación
Route::resource( 'type_identifications', TypesIdentificationController::class)
    ->except(['show'])
    ->names('type_identification');
//Clientes
Route::resource('clients', ClientController::class)
    ->except(['show'])
    ->names('clients');

//Comisiones index
Route::get('list_comission', function(){
    return view('comision.index ');
})->name('list_comission');
    
//Reportes index
Route::get('reports', function(){
    return view('reportes.index ');
})->name('reports');
    

//Listar pedidos
Route::get('list_orders',  [ListaPedidosController::class, 'index' ])->name('list_orders');
Route::get('list_orders_json',  [ListaPedidosController::class, 'listaRevisionOrders_json' ])->name('list_orders_json');
Route::post('buscar_order', [ListaPedidosController::class, 'buscarFiltrandoOrdenes' ])->name('orden.procesar.buscar');
Route::get('list_detalle_orders', [ListaPedidosController::class, 'ListaDetalleOrders_json' ])->name('lista.orders.detalle');


//Route::get('report', [ReportesController::class, 'generateReport' ])->name('reportes');
Route::get('reportNuevo', [ReportesController::class, 'index' ]);
// Route::get('list_orders', function(){
//     return view('pedido.show');
// })->name('list_orders');