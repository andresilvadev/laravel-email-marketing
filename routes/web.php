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

# Send email to user with id user in params
Route::get('/email/{id}', function ($id) {
    $user = \App\User::findOrFail($id);
    \Mail::to($user)->send(new \App\Mail\CampaignRegistered($user));
});

# Send email to client with id user in params
Route::get('/send_email/{id}','SendController@send_email');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
