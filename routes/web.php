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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', function () {
    return redirect()->route('zone.index');
    //return view('app');
});


Route::get('/login', 'UserController@index')->name('login');
Route::post('/login', 'UserController@login')->name('auth');
Route::get('/logout', 'UserController@logout')->name('logout');

Route::group(['middleware' => 'check.login'], function () {
    Route::resource('zone', 'ZoneController');
    Route::resource('zone/{zone}/record', 'RecordController');
    Route::get('zone/{zone}/record/{record}/active', 'RecordController@active')->name('record.active');
    Route::resource('group', 'RecordGroupController');
    Route::resource('type', 'RecordTypeController');
});
