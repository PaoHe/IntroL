<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProductoController;


## Ruta GET 
Route::get('/inicio', function () {
    return view('welcome'); 
})->name('inicio');

## Ruta POST
Route::post('/formulario', function () {
    return 'Formulario recibido';
})->name('formulario.enviar');

## Ruta PUT
Route::put('/actualizar/{id}', function ($id) {
    return "Actualizando el recurso con ID: $id";
})->name('recurso.actualizar');

## Ruta DELETE
Route::delete('/eliminar/{id}', function ($id) {
    return "Eliminando el recurso con ID: $id";
})->name('recurso.eliminar');

## Ruta con parámetro obligatorio
Route::get('/usuario/{nombre}', function ($nombre) {
    return "Hola, $nombre";
})->name('usuario.mostrar');

## Ruta con parámetro opcional
Route::get('/producto/{nombre?}', function ($nombre = 'Desconocido') {
    return "Producto: $nombre";
})->name('producto.opcional');

## Ruta con restricción por expresión regular
Route::get('/categoria/{id}', function ($id) {
    return "Categoría ID válida: $id";
})->where('id', '[0-9]+')->name('categoria.regex');

## Ruta a un controlador
Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');

## Ruta con middleware
Route::get('/admin', function () {
    return 'Área de administración';
})->middleware('auth')->name('admin.panel');

## Grupo de rutas
Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/perfil', function () {
        return 'Perfil del usuario';
    })->name('perfil');

    Route::get('/configuracion', function () {
        return 'Configuración del sistema';
    })->name('configuracion');
});

## Ruta Resource
Route::resource('productos', ProductoController::class)->names([
    'index' => 'productos.index',
    'create' => 'productos.crear',
    'store' => 'productos.guardar',
    'show' => 'productos.ver',
    'edit' => 'productos.editar',
    'update' => 'productos.actualizar',
    'destroy' => 'productos.eliminar',
]);

## Ruta fallback
Route::fallback(function () {
    return 'Página no encontrada. Revisa la URL.';
})->name('fallback');
