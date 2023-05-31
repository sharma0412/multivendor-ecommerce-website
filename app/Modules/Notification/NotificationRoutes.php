<?php
// company routes new

Route::group(['namespace' => 'App\Modules\Notification', 'middleware' => ['web', 'admin'], 'prefix' => 'notification'], function () {
    // die('hi');
    Route::get('/notification', 'NotificationController@notification')->name('notification');
    Route::post('/notificationSend', 'NotificationController@notificationSend')->name('notificationSend');
});
