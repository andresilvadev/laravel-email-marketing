<?php

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
    return view('auth.login');
});

Route::resource('clients', 'ClientsController');
Route::resource('emails', 'EmailsController');
Route::resource('imagens', 'ImageController');

# Send email to client with id user in params
Route::get('/send_email/{id}','SendController@send_email')->name('email.client');
Route::get('/send_email_all_clients','SendController@send_all')->name('email.all.clients');
Route::get('/config/email','EmailsController@config')->name('email.config');
//Route::get('/imagens','ImageController@index')->name('imagens.index');
//Route::get('/imagens/create','ImageController@create')->name('imagens.create');
//Route::post('/imagens/store','ImageController@store')->name('imagens.store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
