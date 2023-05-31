<?php
// company routes new

Route::group(['namespace' => 'App\WebModules\Home', 'middleware' => 'web'], function () {


    Route::get('/', 'HomeController@webhome')->name('webhome');
    Route::get('/weblogin', 'HomeController@weblogin')->name('weblogin');
    Route::get('/webregister', 'HomeController@webregister')->name('webregister');
    Route::post('/saveusers', 'HomeController@saveusers')->name('saveusers');
    Route::post('/websitelogin', 'HomeController@websitelogin')->name('websitelogin');
    Route::get('/weblogout', 'HomeController@weblogout')->name('weblogout');
    Route::get('/about', 'HomeController@about')->name('about');
    Route::get('/faq', 'HomeController@faq')->name('faq');
    Route::get('/listcategory', 'HomeController@listcategory')->name('listcategory');
    Route::get('/thankyou', 'HomeController@thankyou')->name('thankyou');
    Route::post('/globalsearch', 'HomeController@globalsearch')->name('globalsearch');
    Route::post('/guestaddress', 'HomeController@guestaddress')->name('guestaddress');
    Route::get('/mylist', 'HomeController@mylist')->name('mylist');
});
