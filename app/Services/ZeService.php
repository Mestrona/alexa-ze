<?php

namespace App\Services;

use GuzzleHttp\Client;

class ZeService {

    protected function getClient($bearer = false)
    {
        $headers = [
            'Accept'        => 'application/json',
        ];


        if ($bearer) {
            $headers['Authorization'] = 'Bearer ' . $bearer ;
        }

        $client = new Client( [
            'base_uri' => 'https://www.services.renault-ze.com/',
            'timeout'  => 10.0,
            'headers' => $headers,
        ] );

        return $client;
    }
    public function getBatteryStatus( $username, $password ) {


        $client = $this->getClient();
        $loginResponse = $client->post( '/api/user/login', [
            'json' => [ 'username' => $username, 'password' => $password ]
        ] );

        $loginResult = json_decode($loginResponse->getBody()->getContents());

        $token = $loginResult->token;
        $vin = $loginResult->user->associated_vehicles[0]->VIN;

        $client = $this->getClient($token);

        $batteryResponse = $client->get('/api/vehicle/' . $vin . '/battery');

        $result = json_decode($batteryResponse->getBody()->getContents());

        return $result;
    }

}
