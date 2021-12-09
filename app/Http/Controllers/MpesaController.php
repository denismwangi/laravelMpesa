<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MpesaController extends Controller
{
    //

    public function getAccessToken()
    {
        $url = env('MPESA_ENV') == 0
        ? 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials'
        : 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

        $curl = curl_init($url);
        curl_setopt_array(
            $curl, 
            array(

            CURLOPT_HTTPHEADER => ['Content-Type: application/json; charset=utf8'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_USERPWD => env('MPESA_CONSUMER_KEY').':'.env('MPESA_CONSUMER_SECRET'),
        )
    );
        $response = json_decode(curl_exec($curl));
        curl_close($curl);

        return $response->access_token;

    }

    public function registerURLS(){

        $body = array(
            'ShortCode' => env('MPESA_SHORTCODE'),
            'ResponseType' => 'Completed',
            'ConfirmationURL' => env('MPESA_TEST_URL').'/api/mobile-money/confirmation',
            'ValidationURL' => env('MPESA_TEST_URL').'/api/mobile-money/validation',
        );

        $url = env('MPESA_ENV') == 0
        ? 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl'
        : 'https://api.safaricom.co.ke/mpesa/c2b/v1/registerurl';

        $response = $this->makeHttp($url, $body);
        return $response;

    }
    public function simulateTransaction(){
        $body = array(
            'CommandID' => 'CustomerPayBillOnline',
            'Amount' => $request->amount,
            'Msisdn' => env('MPESA_TEST_MSISDN'),
            'BillRefNumber' => $request->account,
            'ShortCode' => env('MPESA_SHORTCODE'),

        );
        
        $url = env('MPESA_ENV') == 0
        ? 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/simulate'
        : 'https://api.safaricom.co.ke/mpesa/c2b/v1/simulate';

        $response = $this->makeHttp($url, $body);
        return $response;

    }
     public function makeHttp($url, $body)
    {

        // $url = 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/paymentrequest';
        // $curl = curl_init();
        // curl_setopt($curl, CURLOPT_URL, $url);
        // curl_setopt($curl, CURLOPT_HTTPHEADER , array('Content-Type: application/json', 'Authorization:Bearer ACCESS_TOKEN'));
        // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($curl, CURLOPT_POST, true);
        // curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($body));


        $curl = curl_init();
        curl_setopt_array(
            $curl, array(
            
                CURLOPT_URL => $url,
                CURLOPT_HTTPHEADER => array('Content-Type: application/json', 'Authorization:Bearer'.$this->getAccessToken()),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => json_encode($body),
            )
        );
        $curl_response = curl_exec($curl);
        curl_close($curl);
        return $curl_response;

    }
}
