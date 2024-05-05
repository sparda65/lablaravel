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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//rutas Material
Route::get('/material/nuevo', [App\Http\Controllers\MaterialController::class, 'regisMaterial'])->name('materialNuevo');
Route::post('/material/guardar', [App\Http\Controllers\MaterialController::class, 'guardarMaterial'])->name('materialRegistro');
Route::get('/material/editar/{id}', [App\Http\Controllers\MaterialController::class, 'EditMaterial'])->name('EditarMaterial');
Route::post('/material/actualizar', [App\Http\Controllers\MaterialController::class, 'actMaterial'])->name('ActualizarMaterial');
Route::get('/material/listar', [App\Http\Controllers\MaterialController::class, 'listarMateriales'])->name('ListarMaterial');

//rutas Pedido
Route::get('/pedido/nuevo', [App\Http\Controllers\PedidoController::class, 'regisPedido'])->name('pedidoNuevo');
Route::post('/pedido/guardar', [App\Http\Controllers\PedidoController::class, 'guardarPedido'])->name('pedidoRegistro');
Route::get('/pedido/detalle/{id}', [App\Http\Controllers\PedidoController::class, 'detPedido'])->name('pedidoDetalle');
Route::get('/pedido/entregar/{id}', [App\Http\Controllers\PedidoController::class, 'entPedido'])->name('pedidoEntregar');
Route::post('/pedido/confirmarEntrega', [App\Http\Controllers\PedidoController::class, 'confirmaEntPedido'])->name('pedidoConfEntrega');

//rutas PDF
Route::get('/pdf/generate/{id}', [App\Http\Controllers\PDFController::class, 'generarPDF'])->name('generarPDF');//TEST

//rutas Email
Route::get('/mail/send/{id}', [App\Http\Controllers\MailController::class, 'enviarMail'])->name('enviarMail');//TEST
