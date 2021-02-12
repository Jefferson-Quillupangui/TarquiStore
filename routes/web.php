<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\Pedidos\PedidosController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SectorsController;
use App\Http\Controllers\StatusOrderController;
use App\Http\Controllers\TypesIdentificationController;
use App\Http\Controllers\ClientController;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dash', function () {
    return view('dash.index');
})->name('dashboard');

//Auth::routes(['verify' => true]);
//Categorias
Route::middleware(['auth:sanctum', 'verified'])
    ->resource('categories',CategoryController::class)
    ->except(['show'])
    ->names('categories');
//Productos
Route::middleware(['auth:sanctum', 'verified'])
    ->resource('products',ProductController::class)->names('products');
//Pedidos-Registro pedidos
Route::middleware(['auth:sanctum', 'verified'])
    ->get('create_orders',  [PedidosController::class, 'index' ])->name('orders');
Route::middleware(['auth:sanctum', 'verified'])
    ->get('list_clients', [PedidosController::class, 'listaClientes_json' ])->name('clientes.lista');
Route::middleware(['auth:sanctum', 'verified'])
    ->get('list_products', [PedidosController::class, 'listaProductos_json' ])->name('productos.lista');
Route::middleware(['auth:sanctum', 'verified'])
    ->get('lista_orders', [PedidosController::class, 'listaOrders_json' ])->name('orders.lista');
Route::middleware(['auth:sanctum', 'verified'])
    ->get('detalle_orders', [PedidosController::class, 'detalleOrders_json' ])->name('orders.detalle');
Route::middleware(['auth:sanctum', 'verified'])
    ->get('stock_product', [PedidosController::class, 'stock_product_json' ])->name('stock.product');
Route::middleware(['auth:sanctum', 'verified'])
    ->post('generate_order', [PedidosController::class, 'createOrden' ])->name('orden.create');
//Ciudades
Route::middleware(['auth:sanctum', 'verified'])
    ->resource('cities', CityController::class)
    ->except(['show'])
    ->names('ciudades');
//Sectores
Route::middleware(['auth:sanctum', 'verified'])
    ->resource('sectors', SectorsController::class)
    ->except(['show'])
    ->names('sectors');
//Estados de orden
Route::middleware(['auth:sanctum', 'verified'])
    ->resource( 'status_order', StatusOrderController::class)
    ->except(['show'])
    ->names('status_order');
//Tipos de identificación
Route::middleware(['auth:sanctum', 'verified'])
    ->resource( 'type_identifications', TypesIdentificationController::class)
    ->except(['show'])
    ->names('type_identification');
//Clientes
Route::middleware(['auth:sanctum', 'verified'])
    ->resource('clients', ClientController::class)
    ->except(['show'])
    ->names('clients');
//Listar pedidos
Route::middleware(['auth:sanctum', 'verified'])
    ->get('list_orders', function(){
    return view('pedido.show');
})->name('list_orders');