<?php
// company routes new

Route::group(['namespace' => 'App\Modules\Staff', 'middleware' => ['web', 'admin'], 'prefix' => 'staff'], function () {
    // die('hi');
    Route::get('/stafflist', 'StaffController@stafflist')->name('stafflist');
    Route::get('/addstaff', 'StaffController@addstaff')->name('addstaff');
    Route::post('/savestaff', 'StaffController@savestaff')->name('savestaff');
    Route::post('/changestatus/{id}', 'StaffController@changestatus')->name('changestatus');
});
