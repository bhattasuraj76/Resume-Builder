<?php

/** Frontend routes */
Route::group(['namespace' => 'Frontend'], function () {
    Route::get(
        '/',
        [
            'uses' => 'HomeController@index',
            'as' => 'home'
        ]
    );
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
