<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Order;

class WebhookController extends Controller
{
    public function handleStripeWebhook(Request $request)
    {
        $event = $request->all();

        // Log the webhook event for debugging (optional)
        Log::info('Stripe Webhook:', $event);

        // Handle the event
        switch ($event['type']) {
            case 'payment_intent.succeeded':
                $paymentIntent = $event['data']['object'];

                // Handle successful payment intent
                $this->handleSuccessfulPayment($paymentIntent);
                break;

            case 'payment_intent.payment_failed':
                $paymentIntent = $event['data']['object'];

                // Handle failed payment intent
                $this->handleFailedPayment($paymentIntent);
                break;

            // Add more event types as needed
            default:
                return response()->json(['message' => 'Event type not handled'], 200);
        }

        return response()->json(['message' => 'Webhook received'], 200);
    }

    protected function handleSuccessfulPayment($paymentIntent)
    {
        // Retrieve the order using the paymentIntent ID
        $order = Order::where('payment_intent_id', $paymentIntent['id'])->first();

        if ($order) {
            // Update the order status to succeeded
            $order->update(['status_message' => 'Payment succeeded']);
        }

        // Optionally, you can log the successful payment
        Log::info('Payment succeeded for Order ID: ' . $order->id);
    }

    protected function handleFailedPayment($paymentIntent)
    {
        // Retrieve the order using the paymentIntent ID
        $order = Order::where('payment_intent_id', $paymentIntent['id'])->first();

        if ($order) {
            // Update the order status to failed
            $order->update(['status_message' => 'Payment failed']);
        }

        // Optionally, you can log the failed payment
        Log::warning('Payment failed for Order ID: ' . $order->id);
    }
}

