<?php
// company routes new

Route::group(['namespace' => 'App\Modules\Customer', 'middleware' => ['web', 'admin'], 'prefix' => 'customer'], function () {
    // die('hi');
    Route::get('/customerlist', 'CustomerController@customerlist')->name('customerlist');
    Route::post('/customerstatus/{id}', 'CustomerController@customerstatus')->name('customerstatus');
});
