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

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/',['uses'=>'ItemsController@getItem']);
Route::get('Create',['uses'=>'ItemsController@index']);
Route::post('/addItem',['uses'=>'ItemsController@postItem']);
Route::get('/deleteItem/{id}',['uses'=>'ItemsController@deleteItem']);
Route::post('/editItem/{id}',['uses'=>'ItemsController@editItem']);
Route::get('/getOneItem/{id}',['uses'=>'ItemsController@getOneItem']);
Route::get('/publish',['uses'=>'ItemsController@publishItem']);