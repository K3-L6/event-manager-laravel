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
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

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
Route::post('/admin/report/alltypeguestlist/print', 'AdminController@report_alltypeguestlist_print')->name('admin.report.alltypeguestlist.print');
Route::post('/admin/report/alltypeguestlist/excel', 'AdminController@report_alltypeguestlist_excel')->name('admin.report.alltypeguestlist.excel');
Route::get('/admin/report/alltypeguestlistapi', 'AdminController@report_alltypeguestlistapi')->name('admin.report.alltypeguestlist.api');

Route::get('/admin/report/walkinguestlist', 'AdminController@report_walkinguestlist')->name('admin.report.walkinguestlist');
Route::post('/admin/report/walkinguestlist/print', 'AdminController@report_walkinguestlist_print')->name('admin.report.walkinguestlist.print');
Route::post('/admin/report/walkinguestlist/excel', 'AdminController@report_walkinguestlist_excel')->name('admin.report.walkinguestlist.excel');
Route::get('/admin/report/walkinguestlistapi', 'AdminController@report_walkinguestlistapi')->name('admin.report.walkinguestlist.api');


Route::get('/admin/report/preregguestlist', 'AdminController@report_preregguestlist')->name('admin.report.preregguestlist');
Route::post('/admin/report/preregguestlist/print', 'AdminController@report_preregguestlist_print')->name('admin.report.preregguestlist.print');
Route::post('/admin/report/preregguestlist/excel', 'AdminController@report_preregguestlist_excel')->name('admin.report.preregguestlist.excel');
Route::get('/admin/report/preregguestlistapi', 'AdminController@report_preregguestlistapi')->name('admin.report.preregguestlist.api');


Route::get('/admin/report/alltypeguestlogs', 'AdminController@report_alltypeguestlogs')->name('admin.report.alltypeguestlogs');
Route::post('/admin/report/alltypeguestlogs/print', 'AdminController@report_alltypeguestlogs_print')->name('admin.report.alltypeguestlogs.print');
Route::post('/admin/report/alltypeguestlogs/excel', 'AdminController@report_alltypeguestlogs_excel')->name('admin.report.alltypeguestlogs.excel');
Route::get('/admin/report/alltypeguestlogsapi', 'AdminController@report_alltypeguestlogsapi')->name('admin.report.alltypeguestlogs.api');

Route::get('/admin/report/walkinguestlogs', 'AdminController@report_walkinguestlogs')->name('admin.report.walkinguestlogs');
Route::post('/admin/report/walkinguestlogs/print', 'AdminController@report_walkinguestlogs_print')->name('admin.report.walkinguestlogs.print');
Route::post('/admin/report/walkinguestlogs/excel', 'AdminController@report_walkinguestlogs_excel')->name('admin.report.walkinguestlogs.excel');
Route::get('/admin/report/walkinguestlogsapi', 'AdminController@report_walkinguestlogsapi')->name('admin.report.walkinguestlogs.api');

Route::get('/admin/report/preregguestlogs', 'AdminController@report_preregguestlogs')->name('admin.report.preregguestlogs');
Route::post('/admin/report/preregguestlogs/print', 'AdminController@report_preregguestlogs_print')->name('admin.report.preregguestlogs.print');
Route::post('/admin/report/preregguestlogs/excel', 'AdminController@report_preregguestlogs_excel')->name('admin.report.preregguestlogs.excel');
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

Route::get('/admin/report/subeventlist', 'AdminController@report_subeventlist')->name('admin.report.subeventlist');
Route::post('/admin/report/subeventlist/print', 'AdminController@report_subeventlist_print')->name('admin.report.subeventlist.print');
Route::post('/admin/report/subeventlist/excel', 'AdminController@report_subeventlist_excel')->name('admin.report.subeventlist.excel');
Route::get('/admin/report/subeventlistapi', 'AdminController@report_subeventlistapi')->name('admin.report.subeventlistapi');

Route::get('/admin/report/audit', 'AdminCOntroller@report_audit')->name('admin.report.audit');
Route::get('/admin/reoprt/auditapi', 'AdminController@report_auditapi')->name('admin.report.auditapi');

Route::get('/admin/usersetting', 'AdminController@usersetting')->name('admin.usersetting');
Route::get('/admin/usersettingapi', 'AdminController@usersetting_api')->name('admin.usersetting.api');
Route::get('/admin/user/register', 'AdminController@user_register_show')->name('admin.user.register');
Route::post('/admin/user/register', 'AdminController@user_register')->name('admin.user.register');
Route::delete('/admin/user/delete/{id}', 'AdminController@user_delete')->name('admin.user.delete');





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











