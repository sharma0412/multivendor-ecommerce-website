<?php
// company routes new

Route::group(['namespace' => 'App\WebModules\Shop', 'middleware' => 'web'], function () {


    Route::get('/shops', 'ShopController@shops')->name('webshops');
    Route::get('/shopdetails/{id}', 'ShopController@shopdetails')->name('webshopdetails');
    // Route::post('/addtocart', 'ShopController@addtocart')->name('addtocart');
    Route::get('/cart', 'ShopController@cart')->name('webcart');
    Route::get('/updatecart', 'ShopController@updatecart')->name('updatecart');
    Route::get('/removecart/{id}', 'ShopController@removecart')->name('removecart');
    Route::post('/saveCurrentUrl', 'ShopController@saveCurrentUrl')->name('saveCurrentUrl');
    
});


Route::group(['namespace' => 'App\WebModules\Shop', 'middleware' => ['web', 'auth']], function () {

    Route::post('/addtocart', 'ShopController@addtocart')->name('addtocart');
    Route::get('/checkout', 'ShopController@checkout')->name('webcheckout');
    Route::post('/save_useraddress', 'ShopController@save_useraddress')->name('save_useraddress');
    Route::post('/update_useraddress', 'ShopController@update_useraddress')->name('update_useraddress');
    Route::post('/payment', 'ShopController@payment')->name('payment');

});
