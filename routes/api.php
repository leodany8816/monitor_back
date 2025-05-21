<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CfdiController;
use App\Http\Controllers\EncabezadoController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::post('/cfdi', [CfdiController::class, 'index'])->middleware('auth:sanctum');
Route::post('/search', [CfdiController::class, 'search'])->middleware('auth:sanctum');
Route::post('/downloadzip',[CfdiController::class, 'downloadzip'])->middleware('auth:sanctum');
Route::post('/downloadpdf', [CfdiController::class, 'downloadpdf'])->middleware('auth:sanctum');

Route::post('/encabezado', [EncabezadoController::class, 'index'])->middleware('auth:sanctum');

Route::get('/csrf-token', function () {
    return response()->json(['csrf_token' => csrf_token()]);
});

Route::options('{any}', function() {
    return response('', 204)
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
})->where('any', '.*');
