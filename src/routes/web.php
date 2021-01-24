<?php

use Illuminate\Support\Facades\Route;

Route::get('/init', [\Smoetje\LaravelInitAdmin\Http\Controllers\InitadminController::class, 'create'] )
    ->name('init_application')
    ->withoutMiddleware(['\Smoetje\LaravelInitAdmin\Http\Middleware\InitApplication::class']);
Route::post('/init', [\Smoetje\LaravelInitAdmin\Http\Controllers\InitadminController::class, 'store']);
