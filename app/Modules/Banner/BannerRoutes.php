<?php
// company routes new

Route::group(['namespace' => 'App\Modules\Banner', 'middleware' => ['web', 'admin'], 'prefix' => 'banner'], function () {
    // die('hi');

    Route::get('/bannerlist', 'BannerController@bannerlist')->name('bannerlist');
    Route::get('/addbanner', 'BannerController@addbanner')->name('addbanner');
    Route::post('/savebanner', 'BannerController@savebanner')->name('savebanner');
    Route::post('/bannerstatus/{id}', 'BannerController@bannerstatus')->name('bannerstatus');
});
