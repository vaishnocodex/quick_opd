<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Redirect;

class PaymentController extends Controller
{
    public function gateway(Request $request)
    {
        // Retrieve the order ID from the request
        $orderId = $request->query('order_id');

        // Find the order in the database
        $order = Order::find($orderId);

        if (!$order) {
            return redirect()->route('home')->with('error', 'Order not found');
        }

        // Logic for online payment redirection (e.g., to a payment gateway)
        // For this example, we're just redirecting to a dummy payment page.
        
        // Replace with actual payment gateway integration logic
        if ($order->payment_status === 'pending') {
            return view('payment.gateway', ['order' => $order]);
        }

        return redirect()->route('home')->with('error', 'This order has already been processed.');
    }
}
