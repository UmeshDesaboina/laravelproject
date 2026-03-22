<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['items', 'address'])
            ->where('user_id', auth()->id())
            ->latest();

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $orders = $query->paginate(10);
        $statusCounts = Order::where('user_id', auth()->id())
            ->selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        return view('orders.index', compact('orders', 'statusCounts'));
    }

    public function show($orderNumber)
    {
        $order = Order::with(['items.product', 'address', 'returnRequests'])
            ->where('user_id', auth()->id())
            ->where('order_number', $orderNumber)
            ->firstOrFail();

        return view('orders.show', compact('order'));
    }

    public function cancel(Request $request, $orderNumber)
    {
        $request->validate([
            'reason' => 'required|string|max:500',
        ]);

        $order = Order::where('user_id', auth()->id())
            ->where('order_number', $orderNumber)
            ->firstOrFail();

        if (!in_array($order->status, ['pending', 'confirmed', 'processing'])) {
            return back()->with('error', 'This order cannot be cancelled.');
        }

        $order->update([
            'status' => 'cancelled',
            'cancellation_reason' => $request->reason,
        ]);

        return redirect()->route('orders.show', $orderNumber)
            ->with('success', 'Order cancelled successfully.');
    }
}
