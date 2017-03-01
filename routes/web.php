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

Auth::routes();
Route::get('user/activation/{token}', 'Auth\RegisterController@activateUser')->name('user.activate');

Route::get('/user', 'UserController@index');

Route::get('/userEdit','UserController@userEdit');

Route::post('/editUser/{id}','UserController@edit');

Route::get('/', 'NotesController@index');

Route::get('/add_notes', 'NotesController@getCategory');

Route::post('/add_notes', 'NotesController@addNotePost');

Route::get('/my_notes', 'NotesController@getMyNotes');

Route::get('/edit_note/{id}', 'NotesController@getNote');

Route::post('/note_edit/{id}', 'NotesController@postNoteEdit');

Route::post('/postNoteDelete', 'NotesController@postNoteDelete');

Route::post('/postNote/{id}', 'NotesController@postGetNote');
