<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Carbon;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return response()->json($orders);
    }
    
    // public function index()
    // {
    //     $todayDate = Carbon::now();

    //     $orders = Order::whereDate('created_at', $todayDate)->paginate(10);
    //     return view('orders.index', compact('orders'));
    // }
    public function create()
    {
        return view('orders.create');
    }

    public function store(Request $request)
    {
        //validate
        $request->validate([
            'product_id' => 'bigint|required|max:20',
            'customer_id' => 'string|required|max:20',
            'tracking_no' => 'int|required|max:20',
            'accompaniment_id' => 'bigint|required|max:20',
            'payment_mode' => 'string|required|max:223',
            'total_price' => 'decimal|required|max:20',
            'ordered_date' => 'date|required|max:20',
            'status_message' => 'string|required|max:255',
            'action' => 'string|required|max:255'
        ]);
        //create order
        $order=Order::create([
            'product_id' => $request->product_id,
            'customer_id' => $request->customer_id,
            'accompaniment_id' => $request->accompaniment_id,
            'accompaniment_id' => $request->accompaniment_id,
            'tracking_no' => $request->tracking_no,
            'payment_mode' => $request->payment_mode,
            'total_price' => $request->total_price,
            'ordered_date' => $request->ordered_date,
            'status_message' => $request->status_message,
            'action' => $request->action
        ]);
          return response()->json([
            'success' => true,
            'order_id' => $order->id,
          ]);
        // return redirect('orders/create')->with('status', 'Order Created!');
    }
    public function update(Request $request,int $id)
    {
        $request->validate([
            'product_id' => 'bigint|required|max:20',
            'customer_id' => 'string|required|max:20',
            'tracking_no' => 'int|required|max:20',
            'accompaniment_id' => 'bigint|required|max:20',
            'payment_mode' => 'string|required|max:223',
            'total_price' => 'decimal|required|max:20',
            'ordered_date' => 'date|required|max:20',
            'status_message' => 'string|required|max:255',
            'action' => 'string|required|max:255'
        ]);
        Order::create([
            'product_id' => $request->product_id,
            'customer_id' => $request->customer_id,
            'accompaniment_id' => $request->accompaniment_id,
            'accompaniment_id' => $request->accompaniment_id,
            'tracking_no' => $request->tracking_no,
            'payment_mode' => $request->payment_mode,
            'total_price' => $request->total_price,
            'ordered_date' => $request->ordered_date,
            'status_message' => $request->status_message,
            'action' => $request->action
        ]);
        return redirect()->back()->with('status', 'Orders Updated');
    }
}
