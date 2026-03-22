<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.coupons.index', compact('coupons'));
    }

    public function create()
    {
        return view('admin.coupons.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:coupons,code',
            'type' => 'required|in:percentage,fixed',
            'value' => 'required|numeric|min:0',
            'min_order_amount' => 'nullable|numeric|min:0',
            'max_discount' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:1',
            'per_user_limit' => 'nullable|integer|min:1',
            'starts_at' => 'nullable|date',
            'expires_at' => 'nullable|date|after_or_equal:starts_at',
        ]);

        $data = $validated;
        $data['code'] = strtoupper($validated['code']);
        $data['is_active'] = $request->boolean('is_active', true);
        
        if ($request->filled('starts_at')) {
            $data['starts_at'] = \Carbon\Carbon::parse($request->starts_at)->startOfDay();
        } else {
            $data['starts_at'] = null;
        }
        
        if ($request->filled('expires_at')) {
            $data['expires_at'] = \Carbon\Carbon::parse($request->expires_at)->endOfDay();
        } else {
            $data['expires_at'] = null;
        }

        $data['applicable_products'] = $request->applicable_products ? array_filter($request->applicable_products) : null;
        $data['excluded_products'] = $request->excluded_products ? array_filter($request->excluded_products) : null;
        $data['applicable_categories'] = $request->applicable_categories ? array_filter($request->applicable_categories) : null;

        Coupon::create($data);

        return redirect()->route('admin.coupons.index')
            ->with('success', 'Coupon created successfully.');
    }

    public function edit(Coupon $coupon)
    {
        return view('admin.coupons.edit', compact('coupon'));
    }

    public function update(Request $request, Coupon $coupon)
    {
        $validated = $request->validate([
            'code' => ['required', 'string', 'max:50', Rule::unique('coupons', 'code')->ignore($coupon->id)],
            'type' => 'required|in:percentage,fixed',
            'value' => 'required|numeric|min:0',
            'min_order_amount' => 'nullable|numeric|min:0',
            'max_discount' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:1',
            'per_user_limit' => 'nullable|integer|min:1',
            'starts_at' => 'nullable|date',
            'expires_at' => 'nullable|date|after_or_equal:starts_at',
        ]);

        $data = $validated;
        $data['code'] = strtoupper($validated['code']);
        $data['is_active'] = $request->boolean('is_active', false);
        
        if ($request->filled('starts_at')) {
            $data['starts_at'] = \Carbon\Carbon::parse($request->starts_at)->startOfDay();
        } else {
            $data['starts_at'] = null;
        }
        
        if ($request->filled('expires_at')) {
            $data['expires_at'] = \Carbon\Carbon::parse($request->expires_at)->endOfDay();
        } else {
            $data['expires_at'] = null;
        }

        $data['applicable_products'] = $request->applicable_products ? array_filter($request->applicable_products) : null;
        $data['excluded_products'] = $request->excluded_products ? array_filter($request->excluded_products) : null;
        $data['applicable_categories'] = $request->applicable_categories ? array_filter($request->applicable_categories) : null;

        $coupon->update($data);

        return redirect()->route('admin.coupons.index')
            ->with('success', 'Coupon updated successfully.');
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        return redirect()->route('admin.coupons.index')
            ->with('success', 'Coupon deleted successfully.');
    }
}
