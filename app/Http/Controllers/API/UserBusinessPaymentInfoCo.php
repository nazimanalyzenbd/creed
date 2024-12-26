<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use App\Models\Api\Tpayment;
use Stripe\Stripe;
use Stripe\PaymentIntent;
// use Stripe\Customer;
// use Stripe\Subscription;
use Auth;
use DB;

class UserBusinessPaymentInfoCo extends Controller
{
    public function createPayment(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            // Create or retrieve Stripe Customer payment data
            $payment = TPayment::create([
                'business_id' => $request->business_id,
                'payment_method' => $request->payment_method,
                'card_number' => $request->card_number,
                'expire_date' => $request->expire_date,
                'cvc_number' => $request->cvc_number,
                'billing_address' => $request->billing_address,
                'subscription_plan_name' => $request->price_id,
                'payable_amount' => $request->amount,
                'paid_amount' => $request->amount,
                'currency' => 'USD',
                'trx_id' => $request->trx_id,
                'status' => 1,
                'expand' => ['latest_invoice.payment_intent'],
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Payment Success',
                'data' => $payment,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
