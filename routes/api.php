<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Setting\MenuController;
use App\Http\Controllers\Setting\RoleController;
use App\Http\Middleware\JwtMiddleware;

/*
|--------------------------------------------------------------------------
| AUTH PUBLIC (tanpa token)
|--------------------------------------------------------------------------
*/
Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware(JwtMiddleware::class)->group(function () {
        Route::get('/me', [AuthController::class, 'me']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });
});

Route::prefix('setting')->middleware(JwtMiddleware::class)->group(function () {

    Route::prefix('roles')->name('roles.')->controller(RoleController::class)->group(function () {
        Route::post('/show', 'index')->name('index');
        Route::post('/filter', 'dropdown')->name('dropdown');
        Route::get('/detail/{id}', 'detail')->name('detail');
        Route::post('/create', 'store')->name('store');
        Route::put('/update/{id}', 'update')->name('update');
        Route::delete('/delete/{id}', 'destroy')->name('destroy');
        Route::post('/export', 'export')->name('export');
    });

    Route::prefix('menus')->name('menus.')->controller(MenuController::class)->group(function () {
        Route::post('/show', 'index')->name('index');
        Route::post('/filter', 'dropdown')->name('dropdown');
        Route::get('/detail/{id}', 'detail')->name('detail');
        Route::post('/create', 'store')->name('store');
        Route::put('/update/{id}', 'update')->name('update');
        Route::delete('/delete/{id}', 'destroy')->name('destroy');
        Route::post('/export', 'export')->name('export');
    });

});