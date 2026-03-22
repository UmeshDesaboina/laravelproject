<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\ReturnRequest;
use Illuminate\Http\Request;

class AdminReturnController extends Controller
{
    public function index(Request $request)
    {
        $query = ReturnRequest::with(['user', 'order', 'orderItem']);

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $returns = $query->latest()->paginate(15);
        $statusCounts = ReturnRequest::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        return view('admin.returns.index', compact('returns', 'statusCounts'));
    }

    public function show($id)
    {
        $return = ReturnRequest::with(['user', 'order', 'orderItem.product', 'orderItem.order'])
            ->findOrFail($id);

        return view('admin.returns.show', compact('return'));
    }

    public function updateStatus(Request $request, ReturnRequest $return)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected,received,refunded',
            'resolution' => 'required_if:status,approved|nullable|in:refund,replacement',
            'refund_amount' => 'nullable|numeric|min:0',
            'courier_name' => 'nullable|string|max:255',
            'tracking_id' => 'nullable|string|max:255',
            'admin_notes' => 'nullable|string|max:1000',
        ]);

        $return->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes,
        ]);

        if ($request->status === 'approved') {
            $return->update([
                'resolution' => $request->resolution,
                'refund_amount' => $request->refund_amount ?? $return->orderItem->total,
                'courier_name' => $request->courier_name,
                'tracking_id' => $request->tracking_id,
                'processed_at' => now(),
            ]);
        }

        if ($request->status === 'refunded') {
            $return->update(['refunded_at' => now()]);
            
            if ($return->resolution === 'refund' && $return->refund_amount) {
                Order::find($return->order_id)->decrement('total', $return->refund_amount);
            }
        }

        return back()->with('success', 'Return request updated successfully.');
    }
}
