<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        // Assuming cartItems are passed in the request
        $cartItems = $request->cartItems;
        $totalAmount = $request->totalAmount;

        // Create an Order
        $order = new Order();
        $order->user_id = User::id();
        $order->total_amount = $totalAmount;
        $order->status = 'Pending'; // or 'Completed' based on your logic
        $order->save();

        foreach ($cartItems as $item) {
            $orderItem = new Order();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item['id'];
            $orderItem->accompaniment_id = $item['id'];
            $orderItem->quantity = $item['quantity'];
            $orderItem->price = $item['price'];
            $orderItem->save();
        }
    }
}
