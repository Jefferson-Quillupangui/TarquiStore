<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;

Route::resource('roles',RoleController::class)->names('roles');

Route::resource('users',UserController::class)->names('users');
//->only('index','edit','update') x->('create','store','show','destroy')