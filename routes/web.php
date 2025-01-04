<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'web'])->group(function () {
    Route::get('/', fn() => view('dashboard'));
    Route::get('/dashboard', fn() => view('dashboard'));

    Route::get('/profile', App\Http\Controllers\ProfileController::class)->name('profile');

    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::resource('roles', App\Http\Controllers\RoleAndPermissionController::class);
});

Route::middleware(['auth', 'permission:test view'])->get('/tests', function () {
    dd('This is just a test and an example for permission and sidebar menu. You can remove this line on web.php, config/permission.php and config/generator.php');
})->name('tests.index');

Route::middleware(['auth', 'web'])->group(function () {
    Route::get('/', fn() => view('dashboard'));
    Route::get('/dashboard', fn() => view('dashboard'));

    Route::get('/profile', App\Http\Controllers\ProfileController::class)->name('profile');

    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::resource('roles', App\Http\Controllers\RoleAndPermissionController::class);
});
Route::resource('diklats', App\Http\Controllers\DiklatController::class)->middleware('auth');
Route::resource('pelaksaan-diklats', App\Http\Controllers\PelaksaanDiklatController::class)->middleware('auth');
Route::resource('alumni', App\Http\Controllers\AlumniController::class)->middleware('auth');
Route::get('/export-alumni', [App\Http\Controllers\AlumniController::class, 'exportData'])->name('alumni.export');
Route::post('/import-alumni', [App\Http\Controllers\AlumniController::class, 'importData'])->name('alumni.import');
Route::get('/import-format', [App\Http\Controllers\AlumniController::class, 'formatData'])->name('format.import');

