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
Route::resource('messages.chat', 'ChatsController')->only(['create', 'store', 'update']);