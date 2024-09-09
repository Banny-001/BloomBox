<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\VarDumper\Cloner\Data;
use App\Http\Controllers\BusinessPayToBulk;

class MpesaController extends Controller
{
    public static $accessBearerToken;
    public function getAccessToken()
    {

        $url = env('MPESA_ENV') == 0
            ? 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials'
            : 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials ';
        // to go live use this then change environment to 1

        $curl = curl_init($url);
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_HTTPHEADER => ['Content-Type: application/json; charset-utf8'],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER => false,
                CURLOPT_USERPWD => env('MPESA_CONSUMER_KEY') . ':' . env('MPESA_CONSUMER_SECRET')
            )
        );
        $response = curl_exec($curl);
        \curl_close($curl);

        // self::$accessBearerToken = $response;
        // return self::$accessBearerToken;
        // \Log::info(json_decode($response, true)['access_token']);
        self::$accessBearerToken = json_decode($response, true)['access_token'];
        // \Log::info(self::$accessBearerToken);
        return $response;
    
    }
    

    //register urls
    public function registerURLS(Request $request)
    {
        $body = array(
            'ShortCode' => env('MPESA_SHORTCODE'),
            'ResponseType' => 'Compeleted',
            'ConfirmationURL' => env('MPESA_TEST_URL') . 'api/confirmation',
            'ValidationURL' => env('MPESA_TEST_URL') . 'api/validation'
        );


        $url = env('MPESA_ENV') == 0
            ? 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl'
            : 'https://api.safaricom.co.ke/mpesa/c2b/v1/registerurl';

        $token = $request->token;


        $response = $this->makeHttp($url, $token, $body);
        
        return $response;
    }
      //STK
    //  public function  stkPush (Request $request)
    //   {
    //     $timestamp = date('YmdHis');
    //      $password =env('MPESA_STK_SHORTCODE').env('MPESA_PASSKEY'). $timestamp;
        
    //     $curl_post_data =array(
    //        'BusinessShortcode'=> env('MPESA_STK_SHORTCODE'),
    //        'Password' => $password,
    //        'Timestamp' => $timestamp,
    //        'TransactionType' => 'CustomerPayBillOnline',
    //        'Amount' => $request->amount,
    //        'PartyA' => $request -> phone,
    //        'PartyB' => env('MPESA_STK_SHORTCODE'),
    //        'PhoneNumber' => $request -> phone,
    //        'CallBackURL' => env('MPESA_TEST_URL'). '/api/stkpush',
    //        'AccountReference' => $request -> account,
    //       'TransactionDesc' => $request -> account
    //     );

    //     $url ='/stkpush/v1/processrequest';
    //     $response =$this->makeHttp($url,$curl_post_data);

    //    return $response;

    //   }

    //simulate transaction
    public function simulateTransaction(Request $request)
    {
        $body = array(
            "ShortCode" => env('MPESA_SHORTCODE'),
            "CommandID" => "CustomerPayBillOnline",
            "Amount" => $request->amount,
            "Msisdn" => '254708374149',
            "BillRefNumber" => $request->account,
        );
        $url = env('MPESA_ENV') == 0
            ? 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/simulate'
            : 'https://api.safaricom.co.ke/mpesa/c2b/v1/simulate';

        $response = $this->makeHttp($url, '', $body);

        return $response;
    }



    //register urls
    public static function makeHttp($url, $token = '', $body)
    {
        //\Log::info('The token is ' . $token);
        $curl = curl_init($url);
        $headers = [
            "Authorization: Bearer " . $token,
            'Content-Type: application/json'
        ];
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($body));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $curl_response  = curl_exec($curl);
        curl_close($curl);

        \Log::info($curl_response);
        return $curl_response;
    }

    
}
