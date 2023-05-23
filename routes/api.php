<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
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
// menampilkan seluruh data yang sudah dihapus sementara oleh softdeletes
Route::get('/students/show/trash', [StudentController::class, 'trash']);
// mengembalikan data spesifik yang sudah dihapus
Route::get('/students/trash/restore/{id}', [StudentController::class, 'restore']);
// menghapus permanen data tertentu
Route::get('/students/trash/delete/permanent/{id}', [StudentController::class, 'permanentDelete']);
