<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\Pedidos\PedidosController;
use App\Http\Controllers\Pedidos\ListaPedidosController;
use App\Http\Controllers\Reportes\ReportesController;
use App\Http\Controllers\Reportes\ReportController;
use App\Http\Controllers\Reportes\MisReportesController;
use App\Http\Controllers\Comisiones\ComisionesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SectorsController;
use App\Http\Controllers\StatusOrderController;
use App\Http\Controllers\TypesIdentificationController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\Dashboard\DashboardController;

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

//Dashboard General
Route::get('dashboard', [DashboardController::class, 'index'])->middleware('can:Dashboard General')->name('dashboard');
Route::post('top_product', [DashboardController::class, 'topProduct'])->name('top.product');
Route::post('cliente_genero', [DashboardController::class, 'clientesGenero'])->name('cliente_genero');

//Dashboard User
Route::get('MiDashboard', [DashboardController::class, 'indexUser'])->middleware('can:Dashboard user')->name('dashboard.user');
Route::post('top_product_user', [DashboardController::class, 'topProductUser'])->name('top.user.product');
Route::post('top_categories_user', [DashboardController::class, 'topCategorytUser'])->name('top.user.category');

//Auth::routes(['verify' => true]);
//Categorias
Route::resource('categories',CategoryController::class)->names('categories');
Route::get('detail_product/{product}/{category}',  [CategoryController::class, 'detailProd' ])->name('detailprod');
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

//RUTAS MANTENIMIENTO
//Ciudades
Route::resource('cities', CityController::class)
    ->except(['show'])->middleware('can:Mantenimiento')
    ->names('ciudades');
//Sectores
Route::resource('sectors', SectorsController::class)
    ->except(['show'])->middleware('can:Mantenimiento')
    ->names('sectors');
//Estados de orden
Route::resource( 'status_order', StatusOrderController::class)
    ->except(['show'])->middleware('can:Mantenimiento')
    ->names('status_order');
//Tipos de identificación
Route::resource( 'type_identifications', TypesIdentificationController::class)
    ->except(['show'])->middleware('can:Mantenimiento')
    ->names('type_identification');

//Clientes
Route::resource('clients', ClientController::class)->names('clients');

//Comisiones index
Route::get('list_comission',  [ComisionesController::class, 'index' ])->name('list_comission');
// Route::get('list_comision_json', [ComisionesController::class, 'verComisiones' ])->name('list_comision_json');
Route::get('buscar_comision', [ComisionesController::class, 'verComisiones' ])->name('comision.buscar.colaborador');
Route::get('buscar_comisiones_colaboradores', [ComisionesController::class, 'comisionesGeneralAdmin' ])->name('comisiones.colaboradores.mes.anio');
//colboradores
Route::get('list_colaboradores_json', [ComisionesController::class, 'verListaColaboradores' ])->name('list_colaboradores_json');
    
//Reportes index
Route::get('reporteComision',  [MisReportesController::class, 'index' ])->middleware('can:Ver reportes')->name('reporteComision');
Route::get('reporteComprasCliente',  [MisReportesController::class, 'ComprasPorCliente' ])->name('reporteComprasCliente');
Route::get('reporteVentasPorVendedor',  [MisReportesController::class, 'VentasPorVendedor' ])->name('reporteVentasPorVendedor');
Route::get('reporteProductosVendidos',  [MisReportesController::class, 'ListaProductosVendidos' ])->name('reporteProductosVendidos');
Route::get('reporteVentasDiaras',  [MisReportesController::class, 'VentasDiariasxMes' ])->name('reporteVentasDiaras');
Route::get('reporteVentasPorCategorias',  [MisReportesController::class, 'VentasPorCategoria' ])->name('reporteVentasPorCategorias');
Route::get('reportePedidosEntregados',  [MisReportesController::class, 'PedidosEntregados' ])->name('reportePedidosEntregados');

Route::POST('reportesPdf',  [MisReportesController::class, 'ReportesPdf' ])->name('reportesPdf');


    

//Listar pedidos
Route::get('list_orders',  [ListaPedidosController::class, 'index' ])->name('list_orders');
Route::get('list_orders_json',  [ListaPedidosController::class, 'listaRevisionOrders_json' ])->name('list_orders_json');
Route::post('buscar_order', [ListaPedidosController::class, 'buscarFiltrandoOrdenes' ])->name('orden.procesar.buscar');
Route::get('list_detalle_orders', [ListaPedidosController::class, 'ListaDetalleOrders_json' ])->name('lista.orders.detalle');
Route::get('list_auditoria_json',  [ListaPedidosController::class, 'listaAuditoriaOrden_json' ])->name('list_orders_auditoria_json');

//PDF Reportes
Route::get('reporte_orden', [ReportController::class, 'PDF' ])->name('reporte.orden');
Route::post('reporte_orden_datos_post', [ReportController::class, 'OrdenPDF' ])->name('reporte_post.orden.datos');
//Route::get('reporte_orden_datos/{id}', [ReportController::class, 'OrdenPDF' ])->name('reporte.orden.datos');





//Route::post('reporte_orden_datos', [ReportController::class, 'ordenDatosPDF' ])->name('reporte.orden.datos');

//Route::get('reporte_orden_datos', [ReportController::class, 'ordenDatosPDF' ])->name('reporte.orden.datos');

//Route::get('report', [ReportesController::class, 'generateReport' ])->name('reportes');
/*
Route::get('reportNuevos', [ReportesController::class, 'index' ]);
Route::get('reportCompileHola', [ReportesController::class, 'reporteHola' ]);
Route::get('reportCompileHolaJasper', [ReportesController::class, 'reporteHolaCompilarPhp' ]);
Route::get('reportJasperBlanco', [ReportesController::class, 'reporteBlanco' ]);
*/

//https://minhbangchu.blogspot.com/2015/11/su-dung-jaspersoft-report-lam-report.html
//Route::get('/reporting', ['uses' =>'ReportController@index', 'as' => 'Report']);
//Route::post('/reporting', ['uses' =>'ReportController@post']);
//Route::post('reporting', [ReportesController::class, 'post' ]);


// Route::get('list_orders', function(){
//     return view('pedido.show');
// })->name('list_orders');