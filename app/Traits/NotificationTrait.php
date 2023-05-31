<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait NotificationTrait
{
    public function sendNotification($firebaseToken, $title, $message)
    {

        $SERVER_API_KEY = 'YOUR FIREBASE SERVER API KEY';
        $data = [
            "registration_ids" => array($firebaseToken),
            "notification" => [
                "title" => $title,
                "body" => $message,
            ]
        ];

        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);
        return $response;
    }
}
