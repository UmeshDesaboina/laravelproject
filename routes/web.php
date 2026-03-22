<?php

use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminReturnController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FileManagerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponController as FrontendCouponController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReturnController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/search', [ShopController::class, 'search'])->name('shop.search');
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/{slug}', [ShopController::class, 'show'])->name('shop.show');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::post('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
Route::put('/cart/{id}', [CartController::class, 'update']);
Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');

Route::post('/coupon/apply', [FrontendCouponController::class, 'apply'])->name('coupon.apply');
Route::post('/coupon/remove', [FrontendCouponController::class, 'remove'])->name('coupon.remove');

Route::post('/wishlist/add/{product}', [ShopController::class, 'addToWishlist'])->name('wishlist.add');
Route::delete('/wishlist/{product}', [ShopController::class, 'removeFromWishlist'])->name('wishlist.remove');

Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');
    
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{orderNumber}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{orderNumber}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
    
    Route::get('/returns', [ReturnController::class, 'index'])->name('returns.index');
    Route::get('/returns/create/{orderNumber}', [ReturnController::class, 'create'])->name('returns.create');
    Route::post('/returns/{orderNumber}', [ReturnController::class, 'store'])->name('returns.store');
    Route::get('/returns/{id}', [ReturnController::class, 'show'])->name('returns.show');

    Route::get('/dashboard', [UserDashboardController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/profile', [UserDashboardController::class, 'profile'])->name('user.profile');
    Route::put('/profile', [UserDashboardController::class, 'updateProfile'])->name('user.profile.update');
    Route::put('/password', [UserDashboardController::class, 'updatePassword'])->name('user.password.update');
    Route::get('/addresses', [UserDashboardController::class, 'addresses'])->name('user.addresses');
    Route::post('/addresses', [UserDashboardController::class, 'storeAddress'])->name('user.addresses.store');
    Route::delete('/addresses/{address}', [UserDashboardController::class, 'destroyAddress'])->name('user.addresses.destroy');
    Route::get('/wishlist', [UserDashboardController::class, 'wishlist'])->name('user.wishlist');
    
    Route::post('/reviews', [ShopController::class, 'storeReview'])->name('reviews.store');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/file-manager', [FileManagerController::class, 'getAll'])->name('file-manager.all');
    Route::get('/file-manager/images', [FileManagerController::class, 'index'])->name('file-manager.images');

    Route::resource('products', AdminProductController::class);
    Route::patch('products/{product}/toggle-status', [AdminProductController::class, 'toggleStatus'])->name('products.toggle-status');
    Route::post('products/images/{image}/primary', [AdminProductController::class, 'setPrimaryImage'])->name('products.set-primary');
    Route::delete('products/images/{image}', [AdminProductController::class, 'deleteImage'])->name('products.delete-image');

    Route::resource('orders', AdminOrderController::class)->only(['index', 'show']);
    Route::patch('orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.update-status');
    Route::patch('orders/{order}/payment', [AdminOrderController::class, 'updatePaymentStatus'])->name('orders.update-payment-status');

    Route::resource('returns', AdminReturnController::class)->only(['index', 'show']);
    Route::patch('returns/{return}/status', [AdminReturnController::class, 'updateStatus'])->name('returns.update-status');

    Route::resource('categories', CategoryController::class);
    Route::resource('coupons', CouponController::class);
    Route::resource('customers', CustomerController::class)->only(['index', 'show']);
});
