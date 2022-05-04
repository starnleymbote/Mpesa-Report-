<?php

namespace App\Http\Controllers;

use App\Classes\Mpesa;
use Illuminate\Http\Request;


class MpesaController extends Controller
{
    
    /**
     * This method is used to confirm MPESA URL
     */
    public function confirmationUrl()
    {
        //MPESA endpoint to register and 
        $ch = curl_init('https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl');

        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer JQQUJCqNtGqFttQHbBakA0vArOGf',
            'Content-Type: application/json'
        ]);
    }

    /**
     * This method is used validate MPESA URL
     */
    public function validationUrl()
    {
        return $accessToken = Mpesa::authorization();

        
        $url = 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl';
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer '.$accessToken,
            'Content-Type: application/json'
        ));

        $post_data = array(
            'ShortCode' => 600247,
            'ResponseType' => 'Completed',
            'ConfirmationURL' => 'https://posthere.io/67c2-4e3c-985d',
            'ValidationURL' => 'https://posthere.io/67c2-4e3c-985d/1',
        );


        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));

        $response = curl_exec($ch);
        //print_r($response);

        
        curl_close($ch);
        //echo $response;
        return $response;
    }


    public static function generateSandBoxToken()
    {

        try {
            $consumer_key = env('MPESA_CONSUMER_KEY');
            $consumer_secret = env('MPESA_CONSUMER_SECRET');
        } catch (\Throwable $th) {
            $consumer_key = env('MPESA_CONSUMER_KEY');
            $consumer_secret = env('MPESA_CONSUMER_SECRET');
        }
        if (!isset($consumer_key) || !isset($consumer_secret)) {
            die("please declare the consumer key and consumer secret as defined in the documentation");
        }
        $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        $credentials = base64_encode($consumer_key . ':' . $consumer_secret);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic ' . $credentials)); //setting a custom header
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $curl_response = curl_exec($curl);
        return json_decode($curl_response)->access_token;
    }
        /**
     * Register validation and confirmation url
     */
    public static function registerUrl()
    {
        try {
            $environment = env('MPESA_ENV');
        } catch (\Throwable $th) {
            $environment = env('MPESA_ENV');
        }
        if ($environment == "live") {
            $url = 'https://api.safaricom.co.ke/mpesa/c2b/v1/registerurl';
            $token = self::generateLiveToken();
        } elseif ($environment == "sandbox") {
            $url = 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl';
            $token = self::generateSandBoxToken();
        } else {
            return json_encode(["Message" => "invalid application status"]);
        }
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer ' . $token));

        $curl_post_data = array(
            //Fill in the request parameters with valid values
            'ShortCode' => env('MPESA_SHORTCODE'),
            'ResponseType' => 'Confirmed',
            'ValidationURL' => env('MPESA_VALIDATION_URL'),
            'ConfirmationURL' => env('MPESA_CONFIRMATION_URL'),
        );

        $data_string = json_encode($curl_post_data);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $curl_response = curl_exec($curl);
        print_r($curl_response);

    }

    public function mpesaData(Request $request)
    {
        \Log::debug("reaching the local host");
        //$content=json_decode($request->getContent());
        //$data = json_decode($request->getContent(),true);

        \Log::alert($data);
    }

    public function customerToBusiness()
    {

        try {
            $environment = env("MPESA_ENV");
        } catch (\Throwable $th) {
            $environment = env("MPESA_ENV");
        }

        if ($environment == "live") {
            $url = 'https://api.safaricom.co.ke/mpesa/c2b/v1/simulate';
            $token = self::generateLiveToken();
        } elseif ($environment == "sandbox") {
            $url = 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/simulate';
            $token = self::generateSandBoxToken();
        } else {
            return json_encode(["Message" => "invalid application status"]);
        }

        self::validationUrl();
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer ' . Mpesa::authorization()));
        $curl_post_data = array(
            'ShortCode' => 600247,
            'CommandID' => 'CustomerBuyGoodsOnline',
            'Amount' => 100,
            'Msisdn' => '254724628580',
            'BillRefNumber' => 'Testing',
        );
        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $curl_response = curl_exec($curl);
        echo $curl_response;

    }


}
