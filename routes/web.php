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

Route::get('/admin/subevent', 'AdminController@allsubevent')->name('admin.subevent');
Route::get('/admin/subevent/register', 'AdminController@subevent_register_show')->name('admin.subevent.register.show');
Route::post('/admin/subevent/register', 'AdminController@subevent_register')->name('admin.subevent.register');
Route::delete('/admin/subevent/delete/{id}', 'AdminController@subevent_delete')->name('admin.subevent.delete');
Route::get('/admin/subeventapi', 'AdminController@allsubevent_api')->name('admin.subevent.api');
Route::get('/admin/subevent/{id}', 'AdminController@subevent')->name('admin.subevent');
Route::put('admin/subevent/{id}', 'AdminController@subevent_update')->name('admin.subevent.update');


Route::get('/admin/guest', 'AdminController@allguest')->name('admin.guest');
Route::get('/admin/guest/register', 'AdminController@guest_register_show')->name('admin.guest.register.show');
Route::post('/admin/guest/register', 'AdminController@guest_register')->name('admin.guest.register');
Route::get('/admin/guestapi', 'AdminController@allguest_api')->name('admin.guest.api');
Route::get('/admin/guest/{id}', 'AdminController@guest')->name('admin.guest');
Route::delete('/admin/guest/delete/{id}', 'AdminController@guest_delete')->name('admin.guest.delete');

Route::get('/admin/audit', 'AdminController@audit')->name('admin.audit');
Route::get('/admin/auditapi', 'AdminController@audit_api')->name('admin.audit.api');



Route::get('/exhibitor', 'ExhibitorController@index')->name('exhibitor');
Route::get('/registrator', 'RegistratorController@index')->name('registrator');
