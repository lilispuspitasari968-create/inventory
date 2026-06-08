<?php

use Illuminate\Support\Facades\Route;

Route::post('register', 'App\Http\Controllers\AuthController@register');
Route::post('login',    'App\Http\Controllers\AuthController@login');

Route::middleware('auth:sanctum')->group(function () {

    // Categories — semua kecuali destroy
    Route::apiResource('categories', 'App\Http\Controllers\CategoryController')
         ->except(['destroy']);
    Route::delete('categories/{category}',
         'App\Http\Controllers\CategoryController@destroy')
         ->middleware('role:admin');

    // Items — semua kecuali destroy
    Route::apiResource('items', 'App\Http\Controllers\ItemController')
         ->except(['destroy']);
    Route::delete('items/{item}',
         'App\Http\Controllers\ItemController@destroy')
         ->middleware('role:admin');

});