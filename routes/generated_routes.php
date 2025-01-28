<?php

use Illuminate\Support\Facades\Route;

Route::post('auth/token', [\App\Http\Controllers\AuthController::class, 'login']);

Route::middleware(['jwt.auth'])->group(function () {
    Route::get('sahistocs/{id}', ['App\Http\Controllers\SahistocController', 'show']);
    Route::post('sahistocs', ['App\Http\Controllers\SahistocController', 'create']);
    Route::post('sahistocs/search', ['App\Http\Controllers\SahistocController', 'search']);

    Route::get('sahistods/{id}', ['App\Http\Controllers\SahistodController', 'show']);
    Route::post('sahistods', ['App\Http\Controllers\SahistodController', 'create']);
    Route::post('sahistods/search', ['App\Http\Controllers\SahistodController', 'search']);

    Route::get('sahistod2s/{id}', ['App\Http\Controllers\Sahistod2Controller', 'show']);
    Route::post('sahistod2s', ['App\Http\Controllers\Sahistod2Controller', 'create']);
    Route::post('sahistod2s/search', ['App\Http\Controllers\Sahistod2Controller', 'search']);

    Route::get('users/{id}', ['App\Http\Controllers\UserController', 'show']);
    Route::post('users', ['App\Http\Controllers\UserController', 'create']);
    Route::post('users/search', ['App\Http\Controllers\UserController', 'search']);

    Route::get('wuaos/{id}', ['App\Http\Controllers\WuaoController', 'show']);
    Route::post('wuaos', ['App\Http\Controllers\WuaoController', 'create']);
    Route::post('wuaos/search', ['App\Http\Controllers\WuaoController', 'search']);

});
