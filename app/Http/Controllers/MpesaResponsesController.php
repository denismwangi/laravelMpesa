<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class MpesaResponsesController extends Controller
{
    //
    public function confirmation(Request $request){
        Log::info('confirmation url hit');
        Log::info($request->all());

        return  [
            'ResultCode' => 0,
            'ResultDesc' => 'Accept Service',
            'ThirdPartyTransId' => rand(300, 10000)
        ];
    }
    

    public function validation(Request $request){
        Log::info('validation url hit');
        Log::info($request->all());
        return  [
            'ResultCode' => 0,
            'ResultDesc' => 'Accept Service',
            'ThirdPartyTransId' => rand(300, 10000)
        ];

    }

    public function stkLog(Request $request)
    {
        Log::info('stk push endpoint hit');
        Log::info($request->all());
        return  [
            'ResultCode' => 0,
            'ResultDesc' => 'Accept Service',
            'ThirdPartyTransId' => rand(300, 10000)
        ];
    }
    public function b2cResult(Request $request)
    {
        Log::info('bc2  endpoint hit');
        Log::info($request->all());
        return  [
            'ResultCode' => 0,
            'ResultDesc' => 'Accept Service',
            'ThirdPartyTransId' => rand(300, 10000)
        ];
    }

    
  
    public function transactionResponse(Request $request){
        Log::info('transactionStatusResponse  endpoint hit');
        Log::info($request->all());
        return [
            'ResultCode' => 0,
            'ResultDesc' => 'Accept Service',
            'ThirdPartyTransID' => rand(3000, 10000)
        ];
    }

    
    public function reversalResponse(Request $request){
        Log::info('reversal  endpoint hit');
        Log::info($request->all());
        return [
            'ResultCode' => 0,
            'ResultDesc' => 'Accept Service',
            'ThirdPartyTransID' => rand(3000, 10000)
        ];
    }

    
      public function balanceResponse(Request $request){
        Log::info('balance  endpoint hit');
        Log::info($request->all());
        return [
            'ResultCode' => 0,
            'ResultDesc' => 'Accept Service',
            'ThirdPartyTransID' => rand(3000, 10000)
        ];
    }
}
