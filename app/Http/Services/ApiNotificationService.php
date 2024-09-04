<?php

namespace App\Http\Services;
use Google\Client as GoogleClient;
use Illuminate\Support\Facades\Http;


class ApiNotificationService
{

    public static function apiNotification($FcmTokens , $body   , $title=null )
    {


        $credentialsFilePath = 'json/file.json';//fire base json file like server key
        $client = new GoogleClient();
        $client->setAuthConfig($credentialsFilePath);
        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
        $client->refreshTokenWithAssertion();
        $token = $client->getAccessToken();

        $access_token = $token['access_token'];

        $headers = [
            "Authorization: Bearer $access_token",
            'Content-Type: application/json'
        ];

        $data = [
            "message" => [
                "token" => $FcmTokens,
                "notification" => [
                    "title" => $title,
                    "body" => $body,
                ],
            ]
        ];
        $payload = json_encode($data);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/v1/projects/hesabak-b484f/messages:send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_VERBOSE, true); // Enable verbose output for debugging
        $response = curl_exec($ch);
        $err = curl_error($ch);
        $result=curl_close($ch);

        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        // Close connection
        curl_close($ch);

        return 1;


    }



}
