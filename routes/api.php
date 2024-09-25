<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CfdiController;
use App\Http\Controllers\EncabezadoController;

// Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::post('/cfdi', [CfdiController::class, 'index'])->middleware('auth:sanctum');
Route::post('/downloadzip',[CfdiController::class, 'downloadzip'])->middleware('auth:sanctum');
Route::post('/downloadpdf', [CfdiController::class, 'downloadpdf'])->middleware('auth:sanctum');

Route::post('/encabezado', [EncabezadoController::class, 'index'])->middleware('auth:sanctum');

Route::get('/csrf-token', function () {
    return response()->json(['csrf_token' => csrf_token()]);
});


// habilitar el cors en ciertas rutas
// Route::middleware(['cors'])->group(function () {
//     Route::post('/login', [AuthController::class, 'login']);
// });
