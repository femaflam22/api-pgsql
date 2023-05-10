<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return view('welcome');
});
// ambil semua data
Route::get('/students', [StudentController::class, 'index']);
// tambah data baru
Route::post('/students/tambah-data', [StudentController::class, 'store']);
// generate token csrrf
Route::get('/generate-token', [StudentController::class, 'createToken']);
// ambil satu data spesifik
Route::get('/students/{id}', [StudentController::class, 'show']);
// mengubah data tertentu
Route::patch('/students/update/{id}', [StudentController::class, 'update']);
// menghapus data tertentu
Route::delete('/students/delete/{id}', [StudentController::class, 'destroy']);