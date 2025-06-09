<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/notificacion', [App\Http\Controllers\NotificacionController::class, 'enviar'])
    ->name('notificacion.enviar');
