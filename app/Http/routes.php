<?php



Route::get('/', function () {
    return view('pages.home');
});

Route::resource('flyers', 'FlyersController');

Route::get('{zip}/{street}', 'FlyersController@show');

//named route store_photo_path
Route::post('{zip}/{street}/photos', ['as' => 'store_photo_path', 'uses' => 'FlyersController@addPhoto']);