<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/test', function () {
    return view('test');
});

Route::get('dql/form', function(){
   return view('dql/form'); 
});

Route::get('dql/command-form', function(){
    $aggregate_id = \Ramsey\Uuid\Uuid::uuid4()->toString();
    return view('dql/command-form', ['aggregate_id'=>$aggregate_id]); 
});

Route::post('dql/command', 'DQLController@command');
Route::post('dql/command-dispatch', 'DQLController@command_dispatch');
