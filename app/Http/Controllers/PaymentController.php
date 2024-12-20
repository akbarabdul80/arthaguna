<?php

namespace App\Http\Controllers;

use App\Http\Requests\WithdrawRequest;
use App\Http\Responses\BaseResponse;
use App\Models\TmpMidtrans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function __construct()

    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }


    public function charge(Request $request)
    {
        // Server key
        $serverKey = config('midtrans.server_key');
        $isProduction = config('midtrans.is_production');

        // API URL
        $apiUrl = $isProduction
            ? 'https://app.midtrans.com/snap/v1/transactions'
            : 'https://app.sandbox.midtrans.com/snap/v1/transactions';

        // Validate request method
        if (!$request->isMethod('post')) {
            return response()->json(['message' => 'Page not found or wrong HTTP request method is used'], 404);
        }

        // Get request body as JSON
        $requestBody = $request->all();

        // Call the Midtrans API
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode($serverKey . ':'),
        ])->post($apiUrl, $requestBody);

        if ($response->failed()) {
            return response()->json(['message' => 'Failed to charge the payment'], 500);
        }

        // User ID
        $customerDetails = $request->input('customer_details');
        $itemDetails = $request->input('item_details');
        $transactionDetails = $request->input('transaction_details');


        // Contoh penggunaan
        $customerIdentifier = $customerDetails['customer_identifier'] ?? null;
        $email = $customerDetails['email'] ?? null;
        $firstName = $customerDetails['first_name'] ?? null;
        $lastName = $customerDetails['last_name'] ?? null;
        $phone = $customerDetails['phone'] ?? null;

        $items = $itemDetails; // Array of items
        $currency = $transactionDetails['currency'] ?? null;
        $grossAmount = $transactionDetails['gross_amount'] ?? null;
        $orderId = $transactionDetails['order_id'] ?? null;

        $invoice_number = 'DP-' . time() . '-' . $customerIdentifier;

        // Save transaction to database
        $tmp_midtrans = new TmpMidtrans();
        $tmp_midtrans->invoice_number = $invoice_number;
        $tmp_midtrans->user_id = $customerIdentifier;
        $tmp_midtrans->amount = $grossAmount;
        $tmp_midtrans->midtrans_transaction_id = $orderId;
        $tmp_midtrans->save();

        // Return response from Midtrans
        return response($response->json(), $response->status());
    }

    public function notification(Request $request)
    {
        $payload = $request->getContent();
        $notification = json_decode($payload);

        $transactionStatus = $notification->transaction_status;
        $orderId = $notification->order_id;
        $fraudStatus = $notification->fraud_status;

        $tmp_midtrans = TmpMidtrans::where('midtrans_transaction_id', $orderId)->first();

        if (!$tmp_midtrans) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        if ($transactionStatus == 'capture') {
            if ($fraudStatus == 'challenge') {
                // TODO set transaction status on your database to 'challenge'
                // and response with 200 OK
                $tmp_midtrans->status = 'challenge';
                $tmp_midtrans->save();
            } else if ($fraudStatus == 'accept') {
                // TODO set transaction status on your database to 'success'
                // and response with 200 OK
                $tmp_midtrans->status = 'success';
                $tmp_midtrans->save();
            }
        } else if ($transactionStatus == 'settlement') {
            // TODO set transaction status on your database to 'success'
            // and response with 200 OK
            $tmp_midtrans->status = 'success';
            $tmp_midtrans->save();
        } else if ($transactionStatus == 'deny') {
            // TODO you can ignore 'deny', because most of the time it allows payment retries
            // and response with 200 OK
            $tmp_midtrans->status = 'deny';
            $tmp_midtrans->save();
        } else if ($transactionStatus == 'cancel' || $transactionStatus == 'expire') {
            // TODO set transaction status on your database to 'failure'
            // and response with 200 OK
            $tmp_midtrans->status = 'failure';
            $tmp_midtrans->save();
        } else if ($transactionStatus == 'pending') {
            // TODO set transaction status on your database to 'pending' / waiting payment
            // and response with 200 OK
            $tmp_midtrans->status = 'pending';
            $tmp_midtrans->save();
        }

        return response()->json(['message' => 'Notification received'], 200);
    }

}
