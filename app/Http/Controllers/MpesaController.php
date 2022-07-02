<?php

namespace App\Http\Controllers;

use App\Classes\Mpesa;
use Illuminate\Http\Request;


class MpesaController extends Controller
{
  
    /**
     * This method register the validation and confirmation urls
     * that will be used as our call back urls in the c2b transactions
     */
    public function registerURLs()
    {

        //Call the authorization method to get the access token
        $accessToken = Mpesa::authorization();
        
        //Mpesa sandbox URL for registering urls
        $url = 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl';
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer '.$accessToken,
            'Content-Type: application/json'
        ));

        $post_data = array(
            'ShortCode' => env('MPESA_SHORTCODE'),
            'ResponseType' => 'Completed',
            'ConfirmationURL' => "https://f194-197-232-61-239.ngrok.io/api/confirmation-response",
            'ValidationURL' => "https://f194-197-232-61-239.ngrok.io/api/validation-response",
        );

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));

        $response = curl_exec($ch);

        curl_close($ch);
        return $response;

    }

    //Confirmation method to receive response from Mpesa once the transaction is successful
    public function mpesaConfirmation(Request $request)
    {
        \Log::alert("message");
        //\Log::alert($request);
    }

    //Validation response
    public function validationResponse($result_code, $result_description)
    {
        $result  = json_decode(["ResultCode" => $result_code, "ResultDesc" => $result_description]);

        $response = new Response();
        $response ->headers->set("Content-Type", "application/json; charset=utf8");
        $response ->setContent($result);

        return $response;

    }
    //Validation Method to allow for third party validations
    public function mpesaValidation()
    {
        $result_code = "0";
        $result_description = "Accepted validation request";

        return $this->validationResponse($result_code, $result_description);
    }

    //Simulate the Mpesa Express
    public function simulateC2B()
    {
        $url = 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/simulate';

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer ' . Mpesa::authorization()));
        $curl_post_data = array(
            'ShortCode' => env('MPESA_SHORTCODE'),
            'CommandID' => env('MPESA_C2B_COMMAND_ID'),
            'Amount' => 100,
            'Msisdn' => '254705822035',
            'BillRefNumber' => 'Testing',
        );
        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        //curl_setopt($curl, CURLOPT_HEADER, false);
        $curl_response = curl_exec($curl);
        curl_close($curl);
        echo $curl_response;

    }

    public function lipaNaMpesa()
    {

        $ch = curl_init('https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . Mpesa::authorization(),
            'Content-Type: application/json'
        )); 

        curl_setopt($ch, CURLOPT_POST, 1);
        $curl_post_data = array(

            "BusinessShortCode" => 174379,
            "Password" => "MTc0Mzc5YmZiMjc5ZjlhYTliZGJjZjE1OGU5N2RkNzFhNDY3Y2QyZTBjODkzMDU5YjEwZjc4ZTZiNzJhZGExZWQyYzkxOTIwMjIwNTMxMTcwODA4",
            "Timestamp" => "20220531170808",
            "TransactionType" => "CustomerPayBillOnline",
            "Amount" => 1,
            "PartyA" => 254792286861,
            "PartyB" => 174379,
            "PhoneNumber" => 254792286861,
            "CallBackURL" => "https://fb5d-197-232-254-86.ngrok.io/api/confirmation-response",
            "AccountReference" => "Stanley Mbote",
            "TransactionDesc" => "Payment of service"
        );

        $data_string = json_encode($curl_post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        $response     = curl_exec($ch);
        curl_close($ch);
        echo $response;
    }


}
