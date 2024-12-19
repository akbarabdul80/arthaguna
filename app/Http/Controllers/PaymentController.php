<?php

namespace App\Http\Controllers;

use App\Http\Requests\WithdrawRequest;
use App\Http\Responses\BaseResponse;
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
        $userId = $request->input('user_id');

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






        // Return response from Midtrans
        return response($response->json(), $response->status());
    }


}
