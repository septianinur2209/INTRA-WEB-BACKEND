<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Master\AreaController;
use App\Http\Controllers\Master\MitraController;
use App\Http\Controllers\Master\RegionalController;
use App\Http\Controllers\Master\STOController;
use App\Http\Controllers\Setting\BatchController;
use App\Http\Controllers\Setting\MenuController;
use App\Http\Controllers\Setting\RoleController;
use App\Http\Controllers\Setting\StatusLapanganController;
use App\Http\Controllers\Setting\StatusLopController;
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

    Route::prefix('batch')->name('batch.')->controller(BatchController::class)->group(function () {
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

    Route::prefix('status-lapangan')->name('status-lapangan.')->controller(StatusLapanganController::class)->group(function () {
        Route::post('/show', 'index')->name('index');
        Route::post('/filter', 'dropdown')->name('dropdown');
        Route::get('/detail/{id}', 'detail')->name('detail');
        Route::post('/create', 'store')->name('store');
        Route::put('/update/{id}', 'update')->name('update');
        Route::delete('/delete/{id}', 'destroy')->name('destroy');
        Route::post('/export', 'export')->name('export');
    });

    Route::prefix('status-lop')->name('status-lop.')->controller(StatusLopController::class)->group(function () {
        Route::post('/show', 'index')->name('index');
        Route::post('/filter', 'dropdown')->name('dropdown');
        Route::get('/detail/{id}', 'detail')->name('detail');
        Route::post('/create', 'store')->name('store');
        Route::put('/update/{id}', 'update')->name('update');
        Route::delete('/delete/{id}', 'destroy')->name('destroy');
        Route::post('/export', 'export')->name('export');
    });

    Route::prefix('roles')->name('roles.')->controller(RoleController::class)->group(function () {
        Route::post('/show', 'index')->name('index');
        Route::post('/filter', 'dropdown')->name('dropdown');
        Route::get('/detail/{id}', 'detail')->name('detail');
        Route::post('/create', 'store')->name('store');
        Route::put('/update/{id}', 'update')->name('update');
        Route::delete('/delete/{id}', 'destroy')->name('destroy');
        Route::post('/export', 'export')->name('export');
    });

});

Route::prefix('master')->middleware(JwtMiddleware::class)->group(function () {

    Route::prefix('area')->name('area.')->controller(AreaController::class)->group(function () {
        Route::post('/show', 'index')->name('index');
        Route::post('/filter', 'dropdown')->name('dropdown');
        Route::get('/detail/{id}', 'detail')->name('detail');
        Route::post('/create', 'store')->name('store');
        Route::put('/update/{id}', 'update')->name('update');
        Route::delete('/delete/{id}', 'destroy')->name('destroy');
        Route::post('/export', 'export')->name('export');
    });

    Route::prefix('mitra')->name('mitra.')->controller(MitraController::class)->group(function () {
        Route::post('/show', 'index')->name('index');
        Route::post('/filter', 'dropdown')->name('dropdown');
        Route::get('/detail/{id}', 'detail')->name('detail');
        Route::post('/create', 'store')->name('store');
        Route::put('/update/{id}', 'update')->name('update');
        Route::delete('/delete/{id}', 'destroy')->name('destroy');
        Route::post('/export', 'export')->name('export');
    });

    Route::prefix('regional')->name('regional.')->controller(RegionalController::class)->group(function () {
        Route::post('/show', 'index')->name('index');
        Route::post('/filter', 'dropdown')->name('dropdown');
        Route::get('/detail/{id}', 'detail')->name('detail');
        Route::post('/create', 'store')->name('store');
        Route::put('/update/{id}', 'update')->name('update');
        Route::delete('/delete/{id}', 'destroy')->name('destroy');
        Route::post('/export', 'export')->name('export');
    });

    Route::prefix('sto')->name('sto.')->controller(STOController::class)->group(function () {
        Route::post('/show', 'index')->name('index');
        Route::post('/filter', 'dropdown')->name('dropdown');
        Route::get('/detail/{id}', 'detail')->name('detail');
        Route::post('/create', 'store')->name('store');
        Route::put('/update/{id}', 'update')->name('update');
        Route::delete('/delete/{id}', 'destroy')->name('destroy');
        Route::post('/export', 'export')->name('export');
    });

});