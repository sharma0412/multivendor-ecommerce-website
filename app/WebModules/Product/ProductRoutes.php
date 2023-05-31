<?php
// company routes new

Route::group(['namespace' => 'App\WebModules\Product', 'middleware' => 'web'], function () {


    Route::get('/productdetails/{id}', 'ProductController@products')->name('productdetails');
});
