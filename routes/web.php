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

Auth::routes();

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('emails', 'EmailsController');
Route::resource('clients', 'ClientsController');
Route::resource('imagens', 'ImageController')->except([
    'edit', 'show', 'update'
]);

Route::get('/import', 'ImportController@getImport')->name('import');
Route::post('/import_parse', 'ImportController@parseImport')->name('import_parse');
Route::post('/import_process', 'ImportController@processImport')->name('import_process');

# Send email to client with id user in params
Route::get('/send_email/{id}','SendController@send_email')->name('email.client');
Route::get('/send_email_all_clients/{email_id}','SendController@send_all')->name('email.all.clients');
Route::get('/config/email','EmailsController@config')->name('email.config');
