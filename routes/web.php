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


Route::get('/', 'MainController@login');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/admin', 'AdminController@index')->name('admin');

Route::get('/admin/event', 'AdminController@event')->name('admin.event');
Route::put('/admin/event', 'AdminController@event_update')->name('admin.event.update');



Route::get('/exhibitor', 'ExhibitorController@index')->name('exhibitor');

Route::get('/registrator', 'RegistratorController@index')->name('registrator');
