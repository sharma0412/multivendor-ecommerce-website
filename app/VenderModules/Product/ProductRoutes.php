<?php
// company routes new

Route::group(['namespace' => 'App\VenderModules\Product', 'middleware' => ['web'], 'prefix' => 'venderproduct'], function () {
    // die('hi');

    Route::get('/venderproduct', 'ProductController@venderproduct')->name('venderproduct');
    Route::get('/addvenderproduct', 'ProductController@addvenderproduct')->name('addvenderproduct');
    Route::post('/savevenderproduct', 'ProductController@savevenderproduct')->name('savevenderproduct');
    Route::post('/venderproductstatus/{id}', 'ProductController@venderproductstatus')->name('venderproductstatus');
});
