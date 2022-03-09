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
        $accessToken = Mpesa::authorization();

        $url = 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer '.$accessToken,
            'Content-Type: application/json'
        ));

        $post_data = array(
            'ShortCode' => 600979,
            'ResponseType' => 'Completed',
            //'ConfirmationURL' => 'https://mydomain.com/confirmation',
            //'ValidationURL' => 'https://mydomain.com/validation',
            'ConfirmationURL' => 'https://posthere.io/ce78-4290-84aa',
            'ValidationURL' => 'https://posthere.io/ce78-4290-84aa',
        );


        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));

        $response = curl_exec($ch);
        print_r($response);

        
        curl_close($ch);
        //echo $response;
        return $response;
    }




}
