<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;

Route::resource('roles',RoleController::class)->names('roles');

Route::resource('users',UserController::class)->names('users');
Route::get('user_status/{user}',  [UserController::class, 'userStatus' ])->name('user.status');
Route::get('change_password/{user}',  [UserController::class, 'cambiarPassword' ])->name('user.pass');
Route::put('update_password/{user}',  [UserController::class, 'updatePassword' ])->name('user.update.pass');
//->only('index','edit','update') x->('create','store','show','destroy')