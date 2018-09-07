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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::post('/question/create', 'QuestionsController@create')->name('createQuestion');
Route::get('/question/like', 'QuestionsController@like')->name('likeQuestion');
Route::get('/question/answer/like', 'AnswersController@like')->name('likeAnswer');
Route::post('/question/answer', 'AnswersController@addAnswer')->name('addAnswer');



