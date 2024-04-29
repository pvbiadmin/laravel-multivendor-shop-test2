<?php

use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\NewsletterController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\FlashSaleController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\ProductTrackController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Frontend\UserAddressController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\Frontend\UserMessageController;
use App\Http\Controllers\Frontend\UserOrderController;
use App\Http\Controllers\Frontend\UserProfileController;
use App\Http\Controllers\Frontend\UserVendorApplyController;
use App\Http\Controllers\Frontend\WishlistController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

/*Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});*/

require __DIR__ . '/auth.php';

Route::get('flash-sale', [FlashSaleController::class, 'index'])->name('flash-sale');

/**
 * Product Routes
 */
Route::get('products', [ProductController::class, 'index'])->name('products.index');
Route::get('product/detail/{slug}', [ProductController::class, 'detail'])->name('product-detail');
Route::get('change-product-tab-view', [ProductController::class, 'changeProductTabView'])
    ->name('change-product-tab-view');
Route::get('change-product-detail-tab-view', [ProductController::class, 'changeProductDetailTabView'])
    ->name('change-product-detail-tab-view');

/**
 * Cart Routes
 */
Route::post('add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');
Route::get('cart-details', [CartController::class, 'cartDetails'])->name('cart-details');
Route::post('cart/update-quantity', [CartController::class, 'updateProductQty'])
    ->name('cart.update-quantity');
Route::get('clear-cart', [CartController::class, 'clearCart'])->name('clear-cart');
Route::get('cart/remove-product/{rowId}', [CartController::class, 'removeProduct'])
    ->name('cart.remove-product');
Route::get('cart-count', [CartController::class, 'getCartCount'])->name('cart-count');
Route::get('cart-items', [CartController::class, 'getCartItems'])->name('cart-items');
Route::post('cart/sidebar/remove-product', [CartController::class, 'removeSidebarProduct'])
    ->name('cart.sidebar.remove-product');
Route::get('cart/sidebar/subtotal', [CartController::class, 'cartSubtotal'])
    ->name('cart.sidebar.subtotal');
Route::get('cart/apply-coupon', [CartController::class, 'applyCoupon'])->name('cart.apply-coupon');
Route::get('cart/coupon-calculation', [CartController::class, 'couponCalculation'])
    ->name('cart.coupon-calculation');

/** Newsletter routes */
Route::post('newsletter-request', [NewsletterController::class, 'newsLetterRequest'])
    ->name('newsletter-request');
Route::get('newsletter-verify/{token}', [NewsletterController::class, 'newsLetterEmailVerify'])
    ->name('newsletter-verify');

/** vendor page routes */
Route::get('vendors', [HomeController::class, 'vendorsPage'])->name('vendors.index');
Route::get('vendor-products/{id}', [HomeController::class, 'vendorProductsPage'])->name('vendor.products');

/** about page route */
Route::get('about', [PageController::class, 'about'])->name('about');

/** terms and conditions page route */
Route::get('terms-and-conditions', [PageController::class, 'termsAndCondition'])
    ->name('terms-and-conditions');

/** contact route */
Route::get('contact', [PageController::class, 'contact'])->name('contact');
Route::post('contact', [PageController::class, 'handleContactForm'])->name('handle-contact-form');

/** Product track route */
Route::get('product-tracking', [ProductTrackController::class, 'index'])->name('product-tracking.index');

/** blog routes */
Route::get('blog-details/{slug}', [BlogController::class, 'blogDetails'])->name('blog-details');
Route::get('blog', [BlogController::class, 'blog'])->name('blog');

Route::get('wishlist/add-product', [WishlistController::class, 'addToWishlist'])
    ->name('wishlist.store');

Route::get('/download/{filename}', function ($filename) {
    $file_path = public_path($filename);

    $headers = [
        'Content-Type' => 'application/vnd.android.package-archive',
        'Content-Disposition' => 'attachment; filename="' . $filename . '"',
    ];

    if (file_exists($file_path)) {
        return response()->download($file_path, $filename, $headers);
    } else {
        return response('File not found', 404);
    }
})->name('download');

Route::group([
    'middleware' => ['auth', 'verified'],
    'prefix' => 'user',
    'as' => 'user.'
], function () {
    Route::get('dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('profile', [UserProfileController::class, 'index'])->name('profile');
    Route::put('profile', [UserProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('profile', [UserProfileController::class, 'updatePassword'])->name('profile.update.password');

    /** Message Route */
    Route::get('messages', [UserMessageController::class, 'index'])->name('messages.index');
    Route::post('send-message', [UserMessageController::class, 'sendMessage'])->name('send-message');
    Route::get('get-messages', [UserMessageController::class, 'getMessages'])->name('get-messages');
    Route::get('get-online-status', [UserMessageController::class, 'getOnlineStatus'])
        ->name('get-online-status');

    /**
     * User Address Route
     */
    Route::resource('address', UserAddressController::class);

    /**
     * Orders Routes
     */
    Route::get('orders', [UserOrderController::class, 'index'])->name('orders.index');
    Route::get('orders/show/{id}', [UserOrderController::class, 'show'])->name('orders.show');

    /**
     * Wishlist Routes
     */
    Route::get('wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::get('wishlist/remove-product/{id}', [WishlistController::class, 'destroy'])
        ->name('wishlist.destroy');

    /** product review routes */
    Route::get('reviews', [ReviewController::class, 'index'])->name('review.index');
    Route::post('review', [ReviewController::class, 'create'])->name('review.create');

    /** blog comment routes */
    Route::post('blog-comment', [BlogController::class, 'comment'])->name('blog-comment');

    /** Vendor request route */
    Route::get('vendor-apply', [UserVendorApplyController::class, 'index'])->name('vendor-apply.index');
    Route::post('vendor-apply', [UserVendorApplyController::class, 'create'])->name('vendor-apply.create');

    /**
     * Checkout Routes
     */
    Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('checkout/address-create', [CheckoutController::class, 'createAddress'])
        ->name('checkout.address-create');
    Route::post('checkout/form-submit', [CheckoutController::class, 'checkoutFormSubmit'])
        ->name('checkout.form-submit');

    /**
     * Payment Routes
     */
    Route::get('payment', [PaymentController::class, 'index'])->name('payment');
    Route::get('payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');

    /**
     * Paypal Routes
     */
    Route::get('paypal/payment', [PaymentController::class, 'payWithPaypal'])->name('paypal.payment');
    Route::get('paypal/success', [PaymentController::class, 'paypalSuccess'])->name('paypal.success');
    Route::get('paypal/cancel', [PaymentController::class, 'paypalCancel'])->name('paypal.cancel');

    /** COD routes */
    Route::get('cod/payment', [PaymentController::class, 'payWithCod'])->name('cod.payment');
});
