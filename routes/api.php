<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/etudiant/search', 'App\Http\Controllers\EtudiantController@search');
Route::get('/etudiant/{etudiant}', 'App\Http\Controllers\EtudiantController@show');
Route::put('/etudiant/{etudiant:uid}', 'App\Http\Controllers\EtudiantController@update');
Route::delete('/etudiant/{etudiant:uid}', 'App\Http\Controllers\EtudiantController@destroy');
Route::apiResource('etudiant', 'App\Http\Controllers\EtudiantController', [
    'except' => ['destroy', 'update', 'show']
]);
