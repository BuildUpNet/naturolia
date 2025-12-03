<?php

use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\Wishlist;
use App\Models\WebsiteSetting;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\WebsiteSettingController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ReturnController;

Route::get('/clear-config', function () {
    Artisan::call('config:clear');
    return "Config cache cleared!";
});

Route::get('/clear-route', function () {
    Artisan::call('route:clear');
    return "Route cache cleared!";
});

Route::get('/clear-view', function () {
    Artisan::call('view:clear');
    return "View cache cleared!";
});

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    return "Application cache cleared!";
});

Route::get('/clear-all', function () {
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
    return "All caches cleared!";
});

//register routes
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('password.forgot.form');

Route::post('forgot-password/send-otp', [ForgotPasswordController::class, 'sendOtp'])->name('password.send.otp');

Route::post('forgot-password/verify-otp', [ForgotPasswordController::class, 'verifyOtp'])->name('password.verify.otp');

Route::get('reset-password', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('password.reset.form');
Route::post('reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.reset');

Route::get('/', function () {
    $products = Product::with(['images' => function ($query) {
        $query->where('top_image', 1);
    }])->get();
    return view('index', compact('products'));
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/product', function () {
    $products = Product::with(['images' => function ($query) {
        $query->where('top_image', 1);
    }])->get();
    return view('product', compact('products'));
})->name('product');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');

Route::get('/contact', [ContactController::class, 'show'])->name('contact');


Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
// Route::get('/category/{id}', [ProductController::class, 'showByCategory'])->name('category.products');


// Cancellation Policy
Route::get('/cancellation', function () {
    return view('cancellation');
})->name('policy.cancellation');

// Returns & Replacements Policy
Route::get('/returns', function () {
    return view('returns');
})->name('policy.returns');

// Refund Policy
Route::get('/refunds', function () {
    return view('refunds');
})->name('policy.refunds');

Route::get('/shipping-policy', function () {
    return view('shipping');
})->name('policy.shipping');

Route::get('/privacy-policy', function () {
    return view('privacy');
})->name('policy.privacy');

Route::get('/terms-condition', function () {
    return view('term-condition');
})->name('policy.terms-condition');

Route::get('/Faq', function () {
    return view('faq');
})->name('policy.faq');

//Admin Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', function () {
         $totalProducts   = Product::count();
        $totalOrders     = Order::count();
       $pendingOrders = Order::where('status', '!=', 'delivered')->count();

        $completedOrders = Order::where('status', 'delivered')->count();
        $cancelledOrders = Order::where('status', 'cancelled')->count();
        $totalCustomers  = User::where('role', 'user')->count(); // adjust as needed

        // Pass data to view
        return view('Admin.Dashboard', compact(
            'totalProducts',
            'totalOrders',
            'pendingOrders',
            'completedOrders',
            'cancelledOrders',
            'totalCustomers'
        ));
    
    })->name('Admin.Dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('admin/settings', [AdminController::class, 'showSettings'])->name('admin.settings');
    Route::post('admin/settings/updateProfile', [AdminController::class, 'updateProfile'])->name('admin.settings.updateProfile');
    Route::post('admin/settings/updatePassword', [AdminController::class, 'updatePassword'])->name('admin.settings.updatePassword');
});
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::delete('/products/{product}/images/{image}', [ProductController::class, 'deleteImage'])->name('products.images.destroy');
});

Route::post('/admin/product-images/toggle-featured/{image}', [ProductController::class, 'toggleFeatured'])
    ->name('admin.product-images.toggle-featured');



Route::get('/account', [UserController::class, 'show'])->name('account.show')->middleware('auth');

Route::middleware(['auth'])->group(function () {
    // Profile management
    Route::get('profile', [UserController::class, 'showProfile'])->name('profile.show');
    Route::put('profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::post('profile/image', [UserController::class, 'updateProfileImage'])->name('profile.image');

    // Account sections
    Route::get('/account/dashboard', [UserController::class, 'AccountDashboard'])->name('account.dashboard');
    Route::get('/account/orders', [UserController::class, 'AccountOrder'])->name('account.orders');
    Route::get('/account/address', [UserController::class, 'AccountAddress'])->name('account.address');
    Route::get('/account/detail', [UserController::class, 'AccountDetail'])->name('account.detail');
      Route::get('/account/delete', [UserController::class, 'showDeleteAccount'])->name('account.delete');
  Route::patch('/account/deactivate', [UserController::class, 'deactivateAccount'])->name('account.deactivate.submit');


    Route::delete('/account/delete', [UserController::class, 'deleteAccount'])->name('account.delete.submit');
});
Route::get('/account/reactivate/{token}', [UserController::class, 'showReactivateFormByToken'])->name('account.reactivate.token');
Route::patch('/account/reactivate/{token}', [UserController::class, 'reactivateAccountByToken'])->name('account.reactivate.token.submit');

Route::post('/account/detail/update', [UserController::class, 'updateUserprofile'])->name('account.update');
Route::delete('/address/{id}', [UserController::class, 'destroy'])->name('address.destroy');
Route::get('/address/{id}/edit', [UserController::class, 'addressedit'])->name('address.edit');
Route::put('/address/{id}', [UserController::class, 'update'])->name('address.update');
Route::post('/account/add-address', [UserController::class, 'storeAddress'])->name('account.add_address');

Route::put('/user/address/update', [UserController::class, 'updateUserAddress'])->name('user.address.update');
Route::delete('/user/address/delete', [UserController::class, 'deleteUserAddress'])->name('user.address.delete');


Route::resource('users', UserController::class)->names([
    'index' => 'admin.user.index',
]);

Route::post('/admin/user/update-status', [UserController::class, 'updateStatus'])->name('admin.user.updateStatus');


Route::resource('admins', AdminController::class)->names([
    'index' => 'admin.admin.index',
]);
Route::post('/settings/update-cod-charge', [AdminController::class, 'updateCodCharge'])
    ->name('admin.updateCodCharge');
    
Route::post('/orders/{id}/return', [OrderController::class, 'returnOrder'])
    ->name('orders.return')
    ->middleware('auth');
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('orders/pending', [OrderController::class, 'pending'])->name('admin.orders.pending');
    Route::patch('orders/{order}/status', [OrderController::class, 'orderStatus'])->name('admin.orders.status');
    Route::get('orders/completed', [OrderController::class, 'completed'])->name('admin.orders.completed');
});
Route::get('/admin/orders/all', [OrderController::class, 'allOrders'])->name('admin.orders.all');
Route::post('/admin/orders/{id}/refund', [OrderController::class, 'processRefund'])->name('admin.orders.refund');
Route::get('/admin/orders/cancelled', [OrderController::class, 'cancelledOrders'])->name('admin.orders.cancelled');

Route::get('/orders/track/{order}', [OrderController::class, 'track'])->name('orders.track');
Route::post('/orders/{id}/cancel', [OrderController::class, 'cancelOrder'])->name('orders.cancel');
Route::post('/admin/orders/{order}/courier-details', [OrderController::class, 'saveCourierDetails'])->name('admin.orders.courier-details');

Route::post('admin/products/toggle-best/{id}', [ProductController::class, 'toggleBestProduct'])->name('admin.products.toggleBest');

    Route::get('cart', [CartController::class, 'viewCart'])->name('cart.view');
    Route::post('cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::delete('cart/remove/{cartItemId}', [CartController::class, 'removeItem'])->name('cart.remove');
    Route::put('/cart/update/{cartItemId}', [CartController::class, 'updateItemQuantity'])->name('cart.update');
    Route::get('checkout', [CartController::class, 'checkout'])->name('cart.checkout');


Route::post('/checkout/guest', [CheckoutController::class, 'guestCheckout'])->name('checkout.guest.place');
Route::post('/razorpay/verify', [CheckoutController::class, 'razorpayVerify'])->name('razorpay.verify');

    Route::get('checkout', [CheckoutController::class, 'showCheckout'])->name('checkout.show');
    Route::post('/checkout/process', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
    Route::get('/orders/success/{order}', [CheckoutController::class, 'success'])->name('orders.success');

Route::post('/checkout/add_address', [CheckoutController::class, 'addAddress'])->name('checkout.add_address');
// Checkout routes
Route::post('/checkout/create-order', [CheckoutController::class, 'createRazorpayOrder'])->name('checkout.createOrder');
Route::post('/checkout/verify-payment', [CheckoutController::class, 'verifyPayment'])->name('checkout.verifyPayment');

Route::post('/checkout/place-cod-order', [CheckoutController::class, 'placeCodOrder'])
    ->name('checkout.placeCodOrder');
    

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/returns-request', [ReturnController::class, 'index'])->name('admin.returns.request');
    Route::post('/returns/{id}/accept', [ReturnController::class, 'acceptReturn'])->name('admin.return.accept');
    Route::post('/returns/{id}/reject', [ReturnController::class, 'rejectReturn'])->name('admin.return.reject');
    Route::post('/returns/{id}/refund-payment', [ReturnController::class, 'refundPayment'])->name('admin.return.refund');
});
Route::get('/invoice/download/{order}', [CheckoutController::class, 'downloadInvoice'])
    ->name('invoice.download');

