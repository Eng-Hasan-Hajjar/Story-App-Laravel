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


Route::group(['prefix' => 'Cpanel'], function () {


    Route::get('Login',['uses'=>"CpanelController@LoginGet",'as'=>'CpanelLoginGet']);

    Route::post('Login',['uses'=>"CpanelController@LoginPost",'as'=>'CpanelLoginPost']);

    Route::group(['middleware' =>['web','auth:Author']], function () {
    
        Route::get('/',['uses'=>'CpanelController@CpanelGet','as'=>'CpanelGet']);

        Route::get('Logout',['uses'=>'CpanelController@CpanelLogout','as'=>"CpanelLogout"]);

        Route::post('SaveStatus',['uses'=>'CpanelController@SaveStatus','as'=>'SaveStatusPost']);
    
    }); 
});



