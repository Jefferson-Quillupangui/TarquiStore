<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Pedidos\PedidosController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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

Route::resource('categories',CategoryController::class)
    ->names('categories');

Route::resource('products',ProductController::class)->names('products');

//Route::get('create_orders',PedidosController::class)->name('orders');
Route::get('create_orders',  [PedidosController::class, 'index' ])->name('orders');
Route::get('lista_clientes', [PedidosController::class, 'listaClientes_json' ])->name('clientes.lista');
Route::post('generar_orden', [PedidosController::class, 'createOrden' ])->name('orden.create');

//Route::get("/lista-categoria", [CategoriaController::class, "ObtenerListaCategorias"])->name('Lista-Categorias-Json');
