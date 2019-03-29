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
Route::get('/testmodel', function () {
    return view('testmodel');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('messages', 'MessagesController')->except('show');
Route::get('/messages/{message}/{msisdn}','MessagesController@show')->name('messages.show');
//Route::post('/messages/{message}/replies', 'RepliesController@store')->name('replies.store');
Route::resource('messages.replies', 'RepliesController')->only(['store', 'update']);
Route::post('/messages/{message}/corruptionRelated', 'CorruptionRelatedController@store')->name('messages.corruptionRelated');
Route::resource('messages.chat', 'ChatsController')->only(['create', 'store']);
Route::get('/chats/{slug}', 'ChatsController@show')->name('chats.show');
Route::get('/chats', 'ChatsController@index')->name('chats.index');
Route::get('/chats/{slug}/edit', 'ChatsController@edit')->name('chats.edit');
Route::put('/chats/{slug}', 'ChatsController@update')->name('chats.update');
Route::post('/messages/{message}/misuse', 'MisuseController@store')->name('messages.misuse');