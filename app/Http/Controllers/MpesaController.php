<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Models\MpesaTransaction;
class MpesaController extends Controller
{
    //
    public function lipaNaMpesaPassword()
    {
        //timestamp
        //passkey
        //businessShortCode

        $timestamp = Carbon::rawParse('now')->format('YmdHms');
        $passkey = env('MPESA_PASSKEY');
        $businessShortCode = env('MPESA_SHORTCODE');
        $mpesaPassword = base64_encode($businessShortCode.$passkey.$timestamp);

        return $mpesaPassword;

    }

    public function getAccessToken()
    {
        $url = env('MPESA_ENV') == 0
        ? 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials'
        : 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
        $credentials = env('MPESA_CONSUMER_KEY').':'.env('MPESA_CONSUMER_SECRET');

        $curl = curl_init($url);
        curl_setopt_array(
            $curl, 
            array(

            CURLOPT_HTTPHEADER => ['Content-Type: application/json; charset=utf8'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_USERPWD => $credentials,
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

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$this->getAccessToken()));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($body));

        $response = curl_exec($curl);
        return $response;

    }
    public function simulateTransaction(Request $request){
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

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$this->getAccessToken()));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($body));

        $response = $response = curl_exec($curl);
        return $response;

    }

    public function stkPush(Request $request)
    {
        // $user = $request->user;
        $amount = $request->amount;
        $phone =  $request->phone;
        $formatedPhone = substr($phone, 1);//721223344
        $code = "254";
        $phoneNumber = $code.$formatedPhone;//254721223344

        $url = env('MPESA_ENV') == 0
        ? 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest'
        : 'https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest'; 

        $curl_post_data = array(
            'BusinessShortCode' =>env('MPESA_SHORTCODE'),
            'Password' => $this->lipaNaMpesaPassword(),
            'Timestamp' => Carbon::rawParse('now')->format('YmdHms'),
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => $amount,
            'PartyA' => $phoneNumber,
            'PartyB' => env('MPESA_SHORTCODE'),
            'PhoneNumber' => $phoneNumber, 
            'CallBackURL' => env('MPESA_TEST_URL').'/api/mobile-money/stk/callbackurl',
            'AccountReference' => "Mobile Mpney Int",
            'TransactionDesc' => "lipa Na M-PESA",

        );
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$this->getAccessToken()));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($curl_post_data));

        $response = curl_exec($curl);
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


        $consumer_key = env('MPESA_CONSUMER_KEY');
        $consumer_secret= env('MPESA_CONSUMER_SECRET');
        $credentials = base64_encode($consumer_key.":".$consumer_secret);

        $curl = curl_init();
        curl_setopt_array(
            $curl, array(
            
                CURLOPT_URL => $url,
                CURLOPT_HTTPHEADER, array("Authorization: Basic ".$credentials,"Content-Type:application/json"),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => json_encode($body),
            )
        );
        $curl_response = curl_exec($curl);
        curl_close($curl);
        return $curl_response;

    }
     public function reponseUrl(Request $request)
     {
        $response = json_decode($request->getContent());

        $transaction = new MpesaTransaction;
        $transaction->response = json_encode($response);
        $transaction->save();
     }
}
