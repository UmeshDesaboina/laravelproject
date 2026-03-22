<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ReturnRequest;
use Illuminate\Http\Request;

class ReturnController extends Controller
{
    public function index()
    {
        $returns = ReturnRequest::with(['order', 'orderItem'])
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('returns.index', compact('returns'));
    }

    public function create($orderNumber)
    {
        $order = Order::with(['items', 'address'])
            ->where('user_id', auth()->id())
            ->where('order_number', $orderNumber)
            ->firstOrFail();

        if ($order->status !== 'delivered') {
            return redirect()->route('orders.show', $orderNumber)
                ->with('error', 'Only delivered orders can be returned.');
        }

        return view('returns.create', compact('order'));
    }

    public function store(Request $request, $orderNumber)
    {
        $request->validate([
            'order_item_id' => 'required|exists:order_items,id',
            'reason' => 'required|in:defective,wrong_item,not_as_described,changed_mind,damaged_in_transit,other',
            'reason_description' => 'nullable|string|max:1000',
            'bank_account_number' => 'required|string|max:255',
            'bank_ifsc' => 'required|string|max:255',
            'bank_account_name' => 'required|string|max:255',
        ]);

        $order = Order::where('user_id', auth()->id())
            ->where('order_number', $orderNumber)
            ->firstOrFail();

        $orderItem = OrderItem::where('id', $request->order_item_id)
            ->where('order_id', $order->id)
            ->firstOrFail();

        if (ReturnRequest::where('order_item_id', $request->order_item_id)->exists()) {
            return back()->with('error', 'A return request already exists for this item.');
        }

        ReturnRequest::create([
            'order_id' => $order->id,
            'order_item_id' => $request->order_item_id,
            'user_id' => auth()->id(),
            'reason' => $request->reason,
            'reason_description' => $request->reason_description,
            'bank_account_number' => $request->bank_account_number,
            'bank_ifsc' => $request->bank_ifsc,
            'bank_account_name' => $request->bank_account_name,
        ]);

        return redirect()->route('returns.index')
            ->with('success', 'Return request submitted successfully.');
    }

    public function show($id)
    {
        $return = ReturnRequest::with(['order', 'orderItem', 'orderItem.product'])
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        return view('returns.show', compact('return'));
    }
}
