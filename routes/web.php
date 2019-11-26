<?php

Route::get('/', function () {
    return view('welcome');
});
Route::get('/payment','PayumoneyController@index');
Route::post('/send_details',[
    'uses'=>'PayumoneyController@send_details',
    'as'=>'send_details'
]);
Route::post('/getCallbackUrl',[
    'uses'=>'PayumoneyController@getCallbackUrl',
    'as'=>'/getCallbackUrl'
]);
