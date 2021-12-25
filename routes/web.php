<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/','TaskController@index');
 Route::post('/task/store','TaskController@store')->name('store');
Route::get('/task/edit/{id}','TaskController@edit')->name('edit');
Route::post('/task/update/{id}','TaskController@update')->name('update');
Route::post('/task/delete/{id}','TaskController@destory')->name('destory');

Route::resource('students', 'StudentController');
