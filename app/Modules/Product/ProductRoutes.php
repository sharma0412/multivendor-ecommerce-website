<?php
// company routes new

Route::group(['namespace' => 'App\Modules\Product', 'middleware' => ['web', 'admin'], 'prefix' => 'product'], function () {
    // die('hi');

    Route::get('/productlist', 'ProductController@productlist')->name('productlist');
    Route::get('/addproduct', 'ProductController@addproduct')->name('addproduct');
    Route::get('/deleteimage/{id}', 'ProductController@deleteimage')->name('deleteimage');
    Route::post('/saveproduct', 'ProductController@saveproduct')->name('saveproduct');
    Route::post('/productstatus/{id}', 'ProductController@productstatus')->name('productstatus');
});
