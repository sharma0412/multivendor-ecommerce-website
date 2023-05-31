<?php
// company routes new

Route::group(['namespace' => 'App\Modules\Order', 'middleware' => ['web', 'admin'], 'prefix' => 'order'], function () {
    Route::get('/orderlist', 'OrderController@orderlist')->name('orderlist');
    Route::get('/orderstatus', 'OrderController@orderstatus')->name('orderstatus');
    Route::get('/order_details/{id}', 'OrderController@order_details')->name('order_details');
});
