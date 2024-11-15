<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('add', [ProductController::class, 'Add']);

Route::get('fetch', [ProductController::class, 'fetch']);

Route::get('Viewprod/{id}/view', [ProductController::class, 'view']);

Route::get('Editprod/{id}/edit', [ProductController::class, 'edit']);

Route::delete('Deleteprod/{id}', [ProductController::class, 'delete']);

