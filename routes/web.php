<?php

use App\Http\Controllers\TareaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ver_formulario',[TareaController::class,'ver_formulario']);
Route::post('/CrearTarea',[TareaController::class,'CrearTarea']);
Route::get('/VerTareas',[TareaController::class,'VerTareas'])->name('VerTareas');
Route::get('/VerTarea/{id}',[TareaController::class,'VerTarea']);
Route::delete('/delete_tarea/{id}', [TareaController::class, 'delete_tarea'])->name('delete_tarea');
Route::put('/update_tarea/{id}',[TareaController::class,'update_tarea'])->name('update_tarea');

