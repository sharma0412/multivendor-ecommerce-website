<?php
// company routes new

Route::group(['namespace' => 'App\Modules\Category', 'middleware' => ['web', 'admin'], 'prefix' => 'category'], function () {
    // die('hi');
    Route::get('/categorylist', 'CategoryController@categorylist')->name('categorylist');
    Route::get('/addcategory', 'CategoryController@addcategory')->name('addcategory');
    Route::post('/savecategory', 'CategoryController@savecategory')->name('savecategory');
    Route::post('/categorystatus/{id}', 'CategoryController@categorystatus')->name('categorystatus');
});
