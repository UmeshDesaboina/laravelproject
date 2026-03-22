<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        $cartItems = [];
        $subtotal = 0;

        foreach ($cart as $id => $item) {
            $product = Product::with('images')->find($id);
            if ($product) {
                $itemTotal = $product->price * $item['quantity'];
                $subtotal += $itemTotal;
                
                $deliveryCharge = $product->delivery_type === 'fixed' 
                    ? ($product->delivery_charge ?? 0) 
                    : 0;
                
                $cartItems[] = [
                    'product' => $product,
                    'quantity' => $item['quantity'],
                    'item_total' => $itemTotal,
                    'delivery_charge' => $deliveryCharge,
                ];
            }
        }

        $totalDelivery = collect($cartItems)->sum('delivery_charge');
        $discount = session('coupon.discount', 0);
        $total = max(0, $subtotal + $totalDelivery - $discount);

        return view('cart.index', compact('cartItems', 'subtotal', 'totalDelivery', 'total', 'discount'));
    }

    public function add(Request $request, $id = null)
    {
        try {
            $productId = $id ?? $request->product_id;
            $quantity = $request->input('quantity', 1);

            $product = Product::findOrFail($productId);
            
            if ($product->quantity < $quantity) {
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Not enough stock available. Only ' . $product->quantity . ' in stock.'
                    ]);
                }
                return back()->with('error', 'Not enough stock available.');
            }

            $cart = Session::get('cart', []);
            if (isset($cart[$product->id])) {
                $cart[$product->id]['quantity'] += $quantity;
            } else {
                $cart[$product->id] = [
                    'quantity' => $quantity,
                ];
            }
            Session::put('cart', $cart);

            // Recalculate coupon if applied
            if (Session::has('coupon')) {
                $this->recalculateCoupon();
            }

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Product added to cart!',
                    'cart_count' => count($cart),
                ]);
            }

            return redirect()->route('cart.index')->with('success', 'Product added to cart!');
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Something went wrong. Please try again.'
                ], 500);
            }
            return back()->with('error', 'Something went wrong.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($id);
        
        if ($product->quantity < $request->quantity) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Not enough stock available.']);
            }
            return back()->with('error', 'Not enough stock available.');
        }

        $cart = Session::get('cart', []);
        
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            Session::put('cart', $cart);
            
            // Recalculate coupon if applied
            if (Session::has('coupon')) {
                $this->recalculateCoupon();
            }
        }

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return back();
    }

    public function remove($id)
    {
        $cart = Session::get('cart', []);
        unset($cart[$id]);
        Session::put('cart', $cart);

        // Recalculate coupon if applied
        if (Session::has('coupon')) {
            $this->recalculateCoupon();
        }

        if (request()->ajax()) {
            return response()->json(['success' => true, 'cart_count' => count($cart)]);
        }

        return back();
    }

    private function recalculateCoupon()
    {
        $couponData = Session::get('coupon');
        if (!$couponData) return;

        $coupon = \App\Models\Coupon::find($couponData['id']);
        if (!$coupon || !$coupon->isValid(auth()->user())) {
            Session::forget('coupon');
            return;
        }

        $cart = Session::get('cart', []);
        $subtotal = 0;
        foreach ($cart as $id => $item) {
            $product = Product::find($id);
            if ($product) {
                $subtotal += $product->price * $item['quantity'];
            }
        }

        if ($coupon->min_order_amount && $subtotal < $coupon->min_order_amount) {
            Session::forget('coupon');
            return;
        }

        $discount = $coupon->calculateDiscount($subtotal, auth()->user());
        
        $couponData['discount'] = (float)$discount;
        Session::put('coupon', $couponData);
    }

    public function clear()
    {
        Session::forget('cart');
        Session::forget('coupon');
        
        return response()->json(['success' => true]);
    }

    public function count()
    {
        $cart = Session::get('cart', []);
        return response()->json(['count' => count($cart)]);
    }
}
