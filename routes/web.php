<?php
Route::get('/', [
    'as' => 'places.index',
    'uses' => 'PageController@index'
]);
Route::get('list', [
    'as' => 'places.list',
    'uses' => 'PageController@placesList'
]);
Route::resource('place', 'PlaceResourceController');
