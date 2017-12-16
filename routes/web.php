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

Route::get('/', 'DefaultController@index');

Auth::routes();

Route::resource('/post', 'PostController');

Route::resource('/comment', 'CommentController');

Route::get('/home', 'HomeController@index')
       ->name('home');

Route::post('/question', 'QuestionController@postQuestion')->name('qedit');

Route::post('/comment/{id}', 'QuestionController@postCommentStore')->name('comment');
