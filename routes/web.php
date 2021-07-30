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


Route::resource('hotel','HotelController');
Route::resource('admin','AdminController');
Route::resource('chirurgien','ChirurgienController');
Route::resource('clinique','CliniqueController');
Route::resource('client','ClientController');
Route::resource('guichet','GuichetController');
Route::resource('service','ServiceController');



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//hotel Controller
Route::get('/list', 'HotelController@index_list');
Route::get('/listDelete', 'HotelController@index_list_delete');
Route::get('/liste', 'HotelController@index_list_req');
Route::get('/list_adv', 'HotelController@index_advanced');
Route::get('/notificationRead/{id}', 'HotelController@read');
Route::get('/notificationlist', 'HotelController@notif_list');

//Administrateur controller
Route::get('/messages/{id}','AdminController@message_index');
Route::post('/send_message/{id}','AdminController@send_message');
Route::get('/administrateur/userlist','AdminController@user_list');
Route::post('/affichage/','AdminController@update_affichage');
Route::get('/affichage/','AdminController@affichage');
Route::get('/console_d_appel/','AdminController@affichage_admins');
Route::get('/affichage/{id}/','AdminController@update_test');
Route::post('/print/','AdminController@print_values');
Route::get('/print/','AdminController@print_aff');
Route::get('/transferer/{id}','AdminController@client');
Route::post('/transferer/{id}','AdminController@client_update');
Route::get('/rappel/{id}','AdminController@client_rappel');
Route::get('/stats/','AdminController@stats');
Route::get('/todaystats/','AdminController@Todaystats');
Route::get('/everstats/','AdminController@Everstats');
Route::get('/logoutt/','AdminController@logoutt');
Route::post('/add_user/','AdminController@add_user');

Route::get('/print_edit','AdminController@print_edit');
Route::post('/print_edit','AdminController@print_edit_update');

//chirurgiens controlleur
Route::get('/specialite','ChirurgienController@specialite');
Route::post('/specialite_save','ChirurgienController@specialite_save');
Route::get('/chirurgien_delete/{id}','ChirurgienController@destroye');
Route::get('/chirurgien_member/{id}','ChirurgienController@teammember');

//cliniques controller
Route::get('/clin/list', 'CliniqueController@index_list');
Route::get('/clin/liste', 'CliniqueController@index_list_req');

//Clients Controller
Route::get('/clien/clinique/{id}', 'ClientController@next_show');
Route::post('/save/{id}', 'ClientController@save');
Route::get('/clien/list', 'ClientController@done_clients');
Route::get('/clien/{id}', 'ClientController@client_info');
Route::get('/client_delete/{id}','ClientController@destroye');
Route::get('/clien_chirurgien/{id}','ClientController@add_chirurgien');
Route::post('/clien_chirurgien_save/{id}','ClientController@save_chirurgien');

Route::get('/reunion/{id}','AdminController@reunion');
Route::get('/pause/{id}','AdminController@pause');

Route::get('/home', 'HomeController@index')->name('home');
