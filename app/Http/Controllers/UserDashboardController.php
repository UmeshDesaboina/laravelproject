<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\ReturnRequest;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        
        $stats = [
            'totalOrders' => Order::where('user_id', $user->id)->count(),
            'pendingOrders' => Order::where('user_id', $user->id)->whereIn('status', ['pending', 'confirmed', 'processing'])->count(),
            'totalSpent' => Order::where('user_id', $user->id)->where('payment_status', 'paid')->sum('total'),
            'totalReturns' => ReturnRequest::where('user_id', $user->id)->count(),
            'wishlistCount' => Wishlist::where('user_id', $user->id)->count(),
        ];

        $recentOrders = Order::with(['items'])
            ->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        $pendingReturns = ReturnRequest::where('user_id', $user->id)
            ->whereIn('status', ['requested', 'approved'])
            ->count();

        return view('user.dashboard', compact('stats', 'recentOrders', 'pendingReturns'));
    }

    public function profile()
    {
        return view('user.profile', ['user' => auth()->user()]);
    }

    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'phone' => 'nullable|string|max:20',
        ]);

        auth()->user()->update($validated);

        return back()->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        if (!\Hash::check($request->current_password, auth()->user()->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        auth()->user()->update(['password' => \Hash::make($request->password)]);

        return back()->with('success', 'Password updated successfully.');
    }

    public function addresses()
    {
        $addresses = auth()->user()->addresses()->latest()->get();
        return view('user.addresses', compact('addresses'));
    }

    public function storeAddress(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
            'country' => 'nullable|string|max:2',
            'is_default' => 'boolean',
        ]);

        if ($request->boolean('is_default')) {
            auth()->user()->addresses()->update(['is_default' => false]);
        }

        auth()->user()->addresses()->create($validated);

        return back()->with('success', 'Address added successfully.');
    }

    public function destroyAddress(Address $address)
    {
        if ($address->user_id !== auth()->id()) {
            abort(403);
        }

        $address->delete();
        return back()->with('success', 'Address deleted successfully.');
    }

    public function wishlist()
    {
        $wishlists = Wishlist::with(['product.images'])
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(12);

        return view('user.wishlist', compact('wishlists'));
    }

    public function cancelOrder(Request $request, $orderNumber)
    {
        $order = Order::where('user_id', auth()->id())
            ->where('order_number', $orderNumber)
            ->firstOrFail();

        if (!$order->canBeCancelled()) {
            return back()->with('error', 'This order cannot be cancelled.');
        }

        $request->validate([
            'cancellation_reason' => 'required|string|max:500',
        ]);

        $order->update([
            'status' => 'cancelled',
            'cancellation_reason' => $request->cancellation_reason,
        ]);

        return redirect()->route('orders.show', $orderNumber)
            ->with('success', 'Order cancelled successfully.');
    }
}
