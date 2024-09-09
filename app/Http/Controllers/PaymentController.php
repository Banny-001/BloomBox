<?php

namespace App\Http\Controllers;

use ErrorException;
use  Stripe\Stripe;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Stripe\BillingPortal\Session;
use Stripe\Checkout\Session as CheckoutSession;
use Symfony\Component\HttpFoundation\Session\Session as SessionSession;
use Stripe\Error\InvalidRequest;
use Stripe\StripeClient;
use Stripe\PaymentIntent;
use App\Http\Exception;
use Illuminate\Support\Str;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use App\Models\Payment;


class PaymentController extends Controller
{
    public function checkout(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));


        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => $request->amount * 100,
                'currency' => $request->currency,
                  'name'=>$request->cartItems,
                // 'order_data'=>[
                //     'name'=>$product->product->name,
                // ],
                'automatic_payment_methods' => [
                    'enabled' => true,
                    // 'allow_redirects'=> never
                ],
            ]);

            return [
                'token' => (string)Str::uuid(),

                'client_secret' => $paymentIntent->client_secret
            ];
        } catch (ErrorException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function success()
    {
        return view('payment.success');
    }
    public function cancel()
    {
        return view('payment.cancel');
    }

    public function completePayment(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Use the payment intent ID stored when initiating payment
        $paymentIntentId = $request->input('PAYMENT_INTENT_ID');
        $orderData = $request->input('order_data');
        $customerId = $request->input('customer_id');

        try {
            $paymentIntent = PaymentIntent::retrieve($paymentIntentId);

            if ($paymentIntent->status === 'succeeded') {
                DB::beginTrasaction();

                //create order
                $order = Order::create([
                    'product_id' => $orderData['product_id'],
                    'accompaniment_id' => $orderData['accompaniment_id'],
                    'customer_id' => $customerId,
                    'quantity' => $orderData['quantity'],
                    'total_price' => $orderData['amount'] *100,
                    'payment_id' => $orderData['payment_id'],
                    'ordered_date' => $orderData['ordered_date'],
                ]);
                //create payment
                Payment::create([
                    'customer_id' => $customerId,
                    'order_id' => $order->id,
                    'amount' => $orderData['amount'],
                    'payment_intent_id' => $paymentIntentId,
                    'status' => 'succeeded',
                ]);
                DB::commit();
                return response()->json([
                    'success' => true,
                    'message' => 'Order and payment created successfully'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Payment failed'
                ]);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }

        // Complete the payment
    }
}
