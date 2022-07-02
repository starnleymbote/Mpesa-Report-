<?php
namespace App\Classes;

class Mpesa{

    /**
     * Mpesa Autorization method
     */
    public function authorization()
    {
        header("Access-Control-Allow-Origin: *");

       //$url = 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
       $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';//sandbox url

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);

        //The consumer key and secret are base64-encoded and passed on to the API as
        // an authorization header of type Basic 

        $consumer_key = env('MPESA_CONSUMER_KEY');
        $consumer_secret = env('MPESA_CONSUMER_SECRET');
        $credentials = base64_encode($consumer_key.':'.$consumer_secret);
        
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic '.$credentials)); //setting a custom header
        //curl  _setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $curl_response = curl_exec($curl);
        $response = json_decode($curl_response);
        $oauth_token = $response->access_token;

        curl_close($curl);

        return $oauth_token;

    }



}