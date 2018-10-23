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

// Envia e-mail para o usuário passando o id do usuário
Route::get('/email/{id}', function ($id) {
    $user = \App\User::findOrFail($id);
    \Mail::to($user)->send(new \App\Mail\CampaignRegistered($user));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
