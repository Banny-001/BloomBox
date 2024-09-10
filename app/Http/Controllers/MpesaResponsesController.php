<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class MpesaResponsesController extends Controller
{
    public function validation(Request $request)
    {
     Log::info('Validation endpoint hit');
     Log::info($request ->all());

 //validation and confirmation
     return[
        'ResultCode'=> 0,
        'ResultDesc'=>'Accept Service',
        'ThirdPartyTransID'=> rand(3000,10000)
     ];
    }
    public function stkpush(Request $request)
    {
     Log::info('STK Push endpoint hit');
     Log::info($request ->all());
     return[
           'ResultCode'=>0,
           'ResultDesc'=>'Accept Service',
           'ThirdPartyTransID'=>rand(3000,10000)
     ];
    }

    public function confirmation(Request $request)
    {
     Log::info('Confirmation endpoint hit');
     Log::info($request ->all());
     return[
        'ResultCode'=>0,
        'ResultDesc'=>'Accept Service',
        'ThirdPartyTransID'=>rand(3000,10000)
  ];
    }

}
