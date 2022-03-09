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


        $credentials = base64_encode('JHcH1tBv5zB9jATEqgSjnJhG9tUFTKh6:O8Zs4OhuAgGDkxnC');
        //$credentials = base64_encode('zHdFkB3lNsiyMVqSs8WIfB4G84ivhu0y:Bbc0W7tKDhOEWL6a');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic '.$credentials)); //setting a custom header
        //curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $curl_response = curl_exec($curl);
        $response = json_decode($curl_response);
        $oauth_token = $response->access_token;

        curl_close($curl);

        return $oauth_token;

    }

}