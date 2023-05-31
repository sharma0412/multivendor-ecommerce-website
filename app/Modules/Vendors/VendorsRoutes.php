<?php
// company routes new

Route::group(['namespace' => 'App\Modules\Vendors', 'middleware' => ['web', 'admin'], 'prefix' => 'vendors'], function () {
    // die('hi');
    Route::get('/vendorlist', 'VendorsController@vendorlist')->name('vendorlist');
    Route::get('/addvendor', 'VendorsController@addvendor')->name('addvendor');
    Route::get('/vendordetails', 'VendorsController@vendordetails')->name('vendordetails');
    Route::post('/savesvendor', 'VendorsController@savesvendor')->name('savesvendor');
    Route::post('/vendorstatus/{id}', 'VendorsController@vendorstatus')->name('vendorstatus');
});
