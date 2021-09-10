<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [ProductController::class, "index"])->name('product.index');
Route::get('product/create',  [ProductController::class, "create"])->middleware(['auth'])->name('product.create');

// Route::get('product', 'ProductController@index')->name('product.index');
Route::get('product/{id}', [ProductController::class, "show"])->name('product.show');
Route::get('product/{id}/edit',  [ProductController::class, "edit"])->middleware(['auth'])->where('id','[0-9]+')->name('product.edit');
Route::post('product',  [ProductController::class, "store"])->middleware(['auth'])->name('product.store');
Route::put('product/{id}' ,  [ProductController::class, "update"])->middleware(['auth'])->where('id','[0-9]+')->name('product.update');
Route::delete('product/{id}',  [ProductController::class, "destroy"])->middleware(['auth'])->where('id','[0-9]+')->name('product.delete');
Route::get('product/{id}/restore',  [ProductController::class, "restore"])->where('id','[0-9]+')->name('product.restore');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
