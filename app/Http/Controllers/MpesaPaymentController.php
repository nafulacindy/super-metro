<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Mpesa;



class MpesaPaymentController extends Controller
{
    public function initiatePayment(Request $request)
{
    
    $mpesa= new \Safaricom\Mpesa\Mpesa();

    $BusinessShortCode = '174379'; 
    $LipaNaMpesaPasskey ='bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
    $TransactionType = 'CustomerPayBillOnline';
    $Amount ='1'; 
    $PartyA = '254793746343';
    $PartyB = '174379';
    $PhoneNumber = '254793746343';
    $CallBackURL = 'http://localhost/mpesa/callback';

    $AccountReference ='AccountReference';
    $TransactionDesc  ='TransactionDesc';
    $Remarks ='Remarks';

    $stkPushSimulation=$mpesa->STKPushSimulation($BusinessShortCode, $LipaNaMpesaPasskey, $TransactionType, $Amount, $PartyA, $PartyB, $PhoneNumber, $CallBackURL, $AccountReference, $TransactionDesc, $Remarks);
    dd($stkPushSimulation);

}
public function handleCallback(Request $request)
{
    // Log the incoming request data for debugging
    Log::info('M-Pesa Callback Received:', $request->all());

    // Extract relevant data from the callback
    $resultCode = $request->input('Body.stkCallback.ResultCode');
    $resultDesc = $request->input('Body.stkCallback.ResultDesc');
    $merchantRequestID = $request->input('Body.stkCallback.MerchantRequestID');
    $checkoutRequestID = $request->input('Body.stkCallback.CheckoutRequestID');
    $amount = $request->input('Body.stkCallback.CallbackMetadata.Item.Amount.0.value');

    // Handle the M-Pesa callback logic here
    // You can update the transaction status in your database, send notifications, etc.

    // Return a response to M-Pesa
    return response()->json(['message' => 'Callback received'], 200);
}

}
