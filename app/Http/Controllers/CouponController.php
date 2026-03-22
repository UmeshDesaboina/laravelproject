<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller
{
    public function apply(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        $coupon = Coupon::where('code', strtoupper($request->code))->first();

        if (!$coupon) {
            return response()->json(['success' => false, 'message' => 'Invalid coupon code.']);
        }

        $user = auth()->user();

        if (!$coupon->isValid($user)) {
            return response()->json(['success' => false, 'message' => 'This coupon has expired or is no longer active.']);
        }

        $cart = Session::get('cart', []);
        $subtotal = 0;

        foreach ($cart as $id => $item) {
            $product = \App\Models\Product::find($id);
            if ($product) {
                $subtotal += $product->price * $item['quantity'];
            }
        }

        if ($coupon->min_order_amount && $subtotal < $coupon->min_order_amount) {
            return response()->json([
                'success' => false,
                'message' => 'Minimum order amount of $' . number_format((float)$coupon->min_order_amount, 2) . ' required.',
            ]);
        }

        $discount = $coupon->calculateDiscount($subtotal, $user);

        $couponData = [
            'id' => $coupon->id,
            'code' => $coupon->code,
            'type' => $coupon->type,
            'value' => (float)$coupon->value,
            'discount' => (float)$discount,
        ];
        
        Session::put('coupon', $couponData);

        return response()->json([
            'success' => true,
            'message' => 'Coupon applied successfully!',
            'discount' => $discount,
            'code' => $coupon->code,
            'coupon' => $couponData
        ]);
    }

    public function remove()
    {
        Session::forget('coupon');
        return response()->json(['success' => true]);
    }
}
