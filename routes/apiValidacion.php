<?php
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Validacion\DocumentoController;

Route::get('validar/Identificacion',  [DocumentoController::class, 'validarIdentificacion' ])->name('validar.identificacion');