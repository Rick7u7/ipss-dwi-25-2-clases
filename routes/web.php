<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('landing/index');
})->name('/');

Route::get('/backoffice/login', [UserController::class, 'showFormLogin'])->name('user.form.show.login');
Route::post('/backoffice/login', [UserController::class, 'login'])->name('user.form.login');

Route::get('/backoffice/create-user', [UserController::class, 'showFormRegistro'])->name('user.form.show.registro');
Route::post('/backoffice/create-user', [UserController::class, 'guardarNuevo'])->name('user.form.registro');

Route::post('/backoffice/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/perfil', [UserController::class, 'verPerfil'])->name('user.perfil')->middleware('auth');
Route::post('/perfil/actualizar', [UserController::class, 'actualizarPerfil'])->name('user.actualizar')->middleware('auth');
