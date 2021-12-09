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
    }

    public function validation(Request $request){
        Log::info('validation url hit');
        Log::info($request->all());
    }
}
