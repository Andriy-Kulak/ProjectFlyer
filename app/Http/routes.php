<?php



Route::get('/', function () {
    return view('pages.home');
});

Route::get('{zip}/{screet}', 'FlyersController@show');

Route::resource('flyers', 'FlyersController');