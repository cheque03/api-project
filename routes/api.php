<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('students/all', 'ApiController@getAllStudents');
Route::get('students/get/{id}', 'ApiController@getStudent');
Route::POST('students/create', 'ApiController@createStudent');
Route::put('students/update/{id}', 'ApiController@updateStudent');
Route::delete('students/delete/{id}', 'ApiController@deleteStudent');