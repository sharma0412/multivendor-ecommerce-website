<?php
// company routes new

Route::group(['namespace' => 'App\Modules\MyListCategory', 'middleware' => ['web', 'admin'], 'prefix' => 'MyListCategory'], function () {
    // die('hi');
    Route::get('/MyListCategorylist', 'MyListCategoryController@MyListCategorylist')->name('MyListCategorylist');
    Route::get('/addMyListCategory', 'MyListCategoryController@addMyListCategory')->name('addMyListCategory');
    Route::post('/saveMyListCategory', 'MyListCategoryController@saveMyListCategory')->name('saveMyListCategory');
    Route::post('/MyListCategorystatus/{id}', 'MyListCategoryController@MyListCategorystatus')->name('MyListCategorystatus');
});
