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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth:sanctum', 'verified'])->get('/dash', function () {
    return view('dash.index');
})->name('dashboard');
//Categorias
Route::resource('categories',CategoryController::class)
    ->except(['show'])
    ->names('categories');
//Productos
Route::resource('products',ProductController::class)->names('products');
//Pedidos-Registro pedidos
Route::get('create_orders',  [PedidosController::class, 'index' ])->name('orders');
Route::get('list_clients', [PedidosController::class, 'listaClientes_json' ])->name('clientes.lista');
Route::post('generate_order', [PedidosController::class, 'createOrden' ])->name('orden.create');
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