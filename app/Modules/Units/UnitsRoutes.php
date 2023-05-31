<?php
// company routes new

Route::group(['namespace' => 'App\Modules\Units', 'middleware' => ['web', 'admin'], 'prefix' => 'units'], function () {
    // die('hi');
    Route::get('/unitslist', 'UnitsController@unitslist')->name('unitslist');
    Route::get('/addunits', 'UnitsController@addunits')->name('addunits');
    Route::post('/saveunits', 'UnitsController@saveunits')->name('saveunits');
    Route::post('/unitstatus/{id}', 'UnitsController@unitstatus')->name('unitstatus');
});
