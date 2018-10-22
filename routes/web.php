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
    return view('welcome');
});

Route::resource('groups', 'GroupsController');

Route::resource('clients', 'ClientsController');

Route::resource('emails', 'EmailsController');

Route::get('/send/{id}', 'SendController@choose_client');
Route::get('/send/group/{id}', 'SendController@choose_group');
Route::get('/send/review/{id_email}/{id_client}', 'SendController@review');
Route::get('/send/group/review/{id_email}/{id_client}', 'SendController@review_group');
Route::get('/send/{id_email}/{id_client}', 'SendController@send');
Route::get('/send/group/{id_email}/{id_client}', 'SendController@send_to_group');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
