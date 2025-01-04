<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingWeb\LandingWebController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




Route::get('/web', function () {
    return redirect()->route('web');
});
Route::get('/', [LandingWebController::class, 'index'])->name('web');
Route::get('/list', [LandingWebController::class, 'list'])->name('web.list');
Route::get('/alumni/search', [LandingWebController::class, 'search'])->name('alumni.search');
Route::get('/detail/{randomNoAbsen}', [LandingWebController::class, 'detail'])->name('web.detail');



Route::prefix('panel')->group(function () {
    Route::middleware(['auth', 'web'])->group(function () {
        Route::get('/', fn() => view('dashboard'));
        Route::get('/dashboard', fn() => view('dashboard'));
        Route::get('/profile', App\Http\Controllers\ProfileController::class)->name('profile');
        Route::resource('users', App\Http\Controllers\UserController::class);
        Route::resource('roles', App\Http\Controllers\RoleAndPermissionController::class);
        Route::resource('diklats', App\Http\Controllers\DiklatController::class);
        Route::resource('pelaksaan-diklats', App\Http\Controllers\PelaksaanDiklatController::class);
        Route::resource('alumni', App\Http\Controllers\AlumniController::class);
        Route::get('/export-alumni', [App\Http\Controllers\AlumniController::class, 'exportData'])->name('alumni.export');
        Route::post('/import-alumni', [App\Http\Controllers\AlumniController::class, 'importData'])->name('alumni.import');
        Route::get('/import-format', [App\Http\Controllers\AlumniController::class, 'formatData'])->name('format.import');
    });

});
