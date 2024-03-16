<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AngelesController;
use App\Http\Controllers\AdminController;

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

Route::get('/', [AngelesController::class, 'index'])->name('inicio');
Route::get('/maquillaje-corporal/{slug}', [AngelesController::class, 'maquillajeCorporal']);
Route::get('/body-painting/{slug}', [AngelesController::class, 'galeria']);
Route::get('/pintura-corporal/{slug}', [AngelesController::class, 'galeria_color']);

Route::get('/cart', [AngelesController::class, 'carrito']);
Route::post('/cart-add', [AngelesController::class, 'carritoAdd'])->name('modCarrito');
Route::post('/checkout', [AngelesController::class, 'checkout']);
Route::get('/response', [AngelesController::class, 'response']);
Route::get('/blog-bodypaint/{id}', [AngelesController::class, 'blog']);
Route::get('/bodypainting-photo/{id}', [AngelesController::class, 'verFoto']);

Route::group(['middleware' => ['auth.basic']], function () {
    Route::get('/admin', [AdminController::class, 'adm']);
    Route::get('/admin/{id}/{slug}', [AdminController::class, 'articulo']);
    Route::post('/admin/save', [AdminController::class, 'articulo_edit'])->name('art_edit');
    Route::get('/admin/{id}/articulo/delete', [AdminController::class, 'adm_art_delete'])->name('adm_art_delete');
    Route::get('/adm_gallery', [AdminController::class, 'adm_gallery']);
    Route::post('/upload-img', [AdminController::class, 'addPhotoPage']);
});

Route::get('/zitro', function () {
    return view('zitro');
});
Route::get('/adminsam', function () {
    return view('admin');
});
Route::get('/cart', function () {
    return view('carrito');
});
Route::get('/cart-clear', function () {
    Session::forget('carrito');
    return 'Eliminado';
});
Route::get('/cart-id', function () {
    return Session::get('carrito', []);
});

Route::get('/ads.txt', function(){
    return 'google.com, pub-8234443054515429, DIRECT, f08c47fec0942fa0';
});

Route::get('/sitemap', [AngelesController::class, 'sitemap'])->name('sitemap');