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
Route::get('/admin/guest/print', 'AdminController@guest_listprint')->name('admin.guest');
Route::post('/admin/guest/print/{id}', 'AdminController@guest_print')->name('admin.guest.print');
Route::put('/admin/guest/update/{id}', 'AdminController@guest_update')->name('admin.guest.update');
Route::delete('/admin/guest/delete/{id}', 'AdminController@guest_delete')->name('admin.guest.delete');
Route::post('/admin/guest/import', 'AdminController@guest_import')->name('admin.guest.import');


Route::get('/admin/audit', 'AdminController@audit')->name('admin.audit');
Route::get('/admin/auditapi', 'AdminController@audit_api')->name('admin.audit.api');


Route::get('/admin/report/alltypeguestlist', 'AdminController@report_alltypeguestlist')->name('admin.report.alltypeguestlist');
Route::get('/admin/report/walkinguestlist', 'AdminController@report_walkinguestlist')->name('admin.report.walkinguestlist');
Route::get('/admin/report/preregguestlist', 'AdminController@report_preregguestlist')->name('admin.report.preregguestlist');
Route::get('/admin/report/alltypeguestlogs', 'AdminController@report_alltypeguestlogs')->name('admin.report.alltypeguestlogs');
Route::get('/admin/report/walkinguestlogs', 'AdminController@report_walkinguestlogs')->name('admin.report.walkinguestlogs');
Route::get('/admin/report/preregguestlogs', 'AdminController@report_preregguestlogs')->name('admin.report.preregguestlogs');


Route::get('/admin/report/alltypeguestlistapi', 'AdminController@report_alltypeguestlistapi')->name('admin.report.alltypeguestlist.api');
Route::get('/admin/report/walkinguestlistapi', 'AdminController@report_walkinguestlistapi')->name('admin.report.walkinguestlist.api');
Route::get('/admin/report/preregguestlistapi', 'AdminController@report_preregguestlistapi')->name('admin.report.preregguestlist.api');
Route::get('/admin/report/alltypeguestlogsapi', 'AdminController@report_alltypeguestlogsapi')->name('admin.report.alltypeguestlogs.api');
Route::get('/admin/report/walkinguestlogsapi', 'AdminController@report_walkinguestlogsapi')->name('admin.report.walkinguestlogs.api');
Route::get('/admin/report/preregguestlogsapi', 'AdminController@report_preregguestlogsapi')->name('admin.report.preregguestlogs.api');

// making
Route::get('/admin/report/subevent', 'AdminController@report_subevent')->name('admin.report.subevent');
Route::get('/admin/report/subeventapi', 'AdminController@report_subevent_api')->name('admin.report.subevent.api');

Route::get('/admin/report/subevent/all/{id}', 'AdminController@report_subevent_alllogs')->name('admin.report.subevent.alllogs');
Route::get('/admin/report/subevent/prereg/{id}', 'AdminController@report_subevent_prereglogs')->name('admin.report.subevent.prereglogs');
Route::get('/admin/report/subevent/walkin/{id}', 'AdminController@report_subevent_walkinlogs')->name('admin.report.subevent.walkinlogs');

Route::get('/admin/report/subevent/allapi/{id}', 'AdminController@report_subevent_alllogs_api')->name('admin.report.subevent.alllogsapi');
Route::get('/admin/report/subevent/preregapi/{id}', 'AdminController@report_subevent_prereglogs_api')->name('admin.report.subevent.prereglogsapi');
Route::get('/admin/report/subevent/walkinapi/{id}', 'AdminController@report_subevent_walkinlogs_api')->name('admin.report.subevent.walkinlogsapi');





Route::get('/exhibitor', 'ExhibitorController@index')->name('exhibitor');

Route::get('/registrator', 'RegistratorController@index')->name('registrator');
Route::get('/registrator/walkin/register', 'RegistratorController@walkin')->name('registrator.walkin');
Route::post('/registrator/walkin/register', 'RegistratorController@guest_register')->name('registrator.walkin');
Route::get('/registrator/prereg', 'RegistratorController@prereg')->name('registrator.prereg');
Route::get('/registrator/prereg/update/{id}', 'RegistratorController@prereg_update_show')->name('registrator.prereg.update');
Route::put('/registrator/prereg/update/{id}', 'RegistratorController@prereg_update')->name('registrator.prereg.update');


Route::get('/event/entrance', 'EventController@entrance');
Route::post('/event/entrance/log', 'EventController@log');

Route::get('/subevent/entrance/{id}', 'SubeventController@entrance');
Route::post('/subevent/entrance/log', 'SubeventController@log');











