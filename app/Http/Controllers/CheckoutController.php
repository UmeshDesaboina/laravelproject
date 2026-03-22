<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

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

        $user = auth()->user();
        $addresses = $user 
            ? Address::where('user_id', $user->id)->get() 
            : collect();

        $totalDelivery = collect($cartItems)->sum('delivery_charge');
        $discount = session('coupon.discount', 0);
        $total = $subtotal + $totalDelivery - $discount;

        $availableCoupons = Coupon::active()->get()->filter(function ($coupon) use ($user) {
            return $coupon->isValid($user);
        });

        return view('checkout.index', compact('cartItems', 'addresses', 'subtotal', 'totalDelivery', 'discount', 'total', 'availableCoupons'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'address_id' => 'required_without_all:full_name,phone,address_line_1,city,state,postal_code|nullable|exists:addresses,id',
            'full_name' => 'required_if:address_id,null|nullable|string|max:255',
            'phone' => 'required_if:address_id,null|nullable|string|max:20',
            'address_line_1' => 'required_if:address_id,null|nullable|string|max:255',
            'city' => 'required_if:address_id,null|nullable|string|max:100',
            'state' => 'required_if:address_id,null|nullable|string|max:100',
            'postal_code' => 'required_if:address_id,null|nullable|string|max:20',
            'payment_method' => 'required|in:cod',
        ]);

        $cart = Session::get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $user = auth()->user();
        $subtotal = 0;
        $totalDelivery = 0;
        $orderItems = [];

        foreach ($cart as $id => $item) {
            $product = Product::find($id);
            if (!$product || $product->quantity < $item['quantity']) {
                return back()->with('error', 'Some products are out of stock. Please update your cart.');
            }
            
            $itemTotal = $product->price * $item['quantity'];
            $subtotal += $itemTotal;
            
            $deliveryCharge = $product->delivery_type === 'fixed' 
                ? ($product->delivery_charge ?? 0) 
                : 0;
            $totalDelivery += $deliveryCharge;
            
            $orderItems[] = [
                'product' => $product,
                'quantity' => $item['quantity'],
                'item_total' => $itemTotal,
                'delivery_charge' => $deliveryCharge,
            ];
        }

        $discount = session('coupon.discount', 0);
        $couponId = session('coupon.id');
        $total = $subtotal + $totalDelivery - $discount;

        if ($request->filled('address_id')) {
            $address = Address::find($request->address_id);
        } else {
            $address = Address::create([
                'user_id' => $user->id,
                'full_name' => $request->full_name,
                'phone' => $request->phone,
                'address_line_1' => $request->address_line_1,
                'address_line_2' => $request->address_line_2,
                'city' => $request->city,
                'state' => $request->state,
                'postal_code' => $request->postal_code,
                'country' => $request->country ?? 'US',
                'type' => 'shipping',
                'is_default' => $user->addresses()->count() === 0,
            ]);
        }

        $order = Order::create([
            'user_id' => $user->id,
            'address_id' => $address->id,
            'coupon_id' => $couponId,
            'status' => 'pending',
            'payment_status' => 'pending',
            'payment_method' => 'cod',
            'subtotal' => $subtotal,
            'shipping_cost' => $totalDelivery,
            'discount' => $discount,
            'tax' => 0,
            'total' => $total,
        ]);

        if ($couponId) {
            $coupon = Coupon::find($couponId);
            if ($coupon) {
                $coupon->increment('used_count');
                \App\Models\CouponUsage::create([
                    'coupon_id' => $coupon->id,
                    'user_id' => $user->id,
                    'order_id' => $order->id,
                ]);
            }
        }

        foreach ($orderItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product']->id,
                'product_name' => $item['product']->name,
                'sku' => $item['product']->sku,
                'price' => $item['product']->price,
                'quantity' => $item['quantity'],
                'subtotal' => $item['item_total'],
                'discount' => 0,
                'tax' => 0,
                'total' => $item['item_total'],
            ]);

            $item['product']->decrement('quantity', $item['quantity']);
        }

        Session::forget('cart');
        Session::forget('coupon');

        return redirect()->route('checkout.success', $order->id);
    }

    public function success($orderId)
    {
        $order = Order::with(['items', 'address', 'coupon'])->where('user_id', auth()->id())->findOrFail($orderId);
        
        return view('checkout.success', compact('order'));
    }
}
