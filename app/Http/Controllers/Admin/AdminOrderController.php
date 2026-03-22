<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['user', 'items']);

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->search) {
            $query->where('order_number', 'like', '%' . $request->search . '%');
        }

        if ($request->date_from) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->date_to) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $orders = $query->latest()->paginate(15);
        $statusCounts = Order::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        return view('admin.orders.index', compact('orders', 'statusCounts'));
    }

    public function show($orderNumber)
    {
        $order = Order::with(['user', 'items.product', 'address'])
            ->where('order_number', $orderNumber)
            ->firstOrFail();

        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,processing,shipped,delivered,cancelled',
            'courier_name' => 'nullable|string|max:255|required_if:status,shipped',
            'tracking_id' => 'nullable|string|max:255|required_if:status,shipped',
            'cancellation_reason' => 'nullable|string|max:500|required_if:status,cancelled',
            'comment' => 'nullable|string|max:500',
        ]);

        $oldStatus = $order->status;
        $updateData = ['status' => $request->status];

        if ($request->status === 'shipped') {
            $updateData['courier_name'] = $request->courier_name;
            $updateData['tracking_id'] = $request->tracking_id;
            $updateData['shipped_at'] = now();
        }

        if ($request->status === 'delivered') {
            $updateData['delivered_at'] = now();
        }

        if ($request->status === 'cancelled') {
            $updateData['cancellation_reason'] = $request->cancellation_reason;
        }

        $order->update($updateData);

        if ($oldStatus !== $request->status) {
            $order->addStatusLog($request->status, $request->comment ?? "Status changed from {$oldStatus} to {$request->status}");
        }

        return back()->with('success', 'Order status updated successfully.');
    }

    public function updatePaymentStatus(Request $request, Order $order)
    {
        $request->validate([
            'payment_status' => 'required|in:pending,paid,failed,refunded',
            'comment' => 'nullable|string|max:500',
        ]);

        $oldPaymentStatus = $order->payment_status;
        $order->update(['payment_status' => $request->payment_status]);

        if ($request->payment_status === 'paid') {
            $order->update(['paid_at' => now()]);
        }

        if ($oldPaymentStatus !== $request->payment_status) {
            $order->addStatusLog($order->status, $request->comment ?? "Payment status changed from {$oldPaymentStatus} to {$request->payment_status}");
        }

        return back()->with('success', 'Payment status updated successfully.');
    }
}
