<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\ReturnRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'totalOrders' => Order::count(),
            'pendingOrders' => Order::where('status', 'pending')->count(),
            'totalRevenue' => Order::where('payment_status', 'paid')->sum('total'),
            'totalUsers' => User::count(),
            'totalProducts' => Product::count(),
            'lowStockProducts' => Product::whereColumn('quantity', '<=', 'low_stock_threshold')->count(),
            'pendingReturns' => ReturnRequest::where('status', 'pending')->count(),
        ];

        $recentOrders = Order::with(['user'])
            ->latest()
            ->take(5)
            ->get();

        $monthlyRevenue = Order::where('payment_status', 'paid')
            ->whereMonth('created_at', now()->month)
            ->sum('total');

        $monthlyOrders = Order::whereMonth('created_at', now()->month)->count();

        $topProducts = DB::table('order_items')
            ->select('product_name', DB::raw('SUM(quantity) as total_sold'), DB::raw('SUM(total) as total_revenue'))
            ->groupBy('product_name')
            ->orderByDesc('total_sold')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentOrders', 'monthlyRevenue', 'monthlyOrders', 'topProducts'));
    }
}
