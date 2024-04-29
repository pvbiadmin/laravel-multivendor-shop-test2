<?php

use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Backend\VendorMessageController;
use App\Http\Controllers\Backend\VendorOrderController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Backend\VendorProductImageGalleryController;
use App\Http\Controllers\Backend\VendorProductReviewController;
use App\Http\Controllers\Backend\VendorProductVariantController;
use App\Http\Controllers\Backend\VendorProductVariantOptionController;
use App\Http\Controllers\Backend\VendorProfileController;
use App\Http\Controllers\Backend\VendorShopProfileController;
use App\Http\Controllers\Backend\VendorWithdrawController;
use Illuminate\Support\Facades\Route;

/**
 * Vendor Routes
 */
Route::get('/', [VendorController::class, 'dashboard'])->name('dashboard');
Route::get('dashboard', [VendorController::class, 'dashboard'])->name('dashboard');
Route::get('profile', [VendorProfileController::class, 'index'])->name('profile');
Route::put('profile', [VendorProfileController::class, 'updateProfile'])->name('profile.update');
Route::post('profile', [VendorProfileController::class, 'updatePassword'])->name('profile.update.password');

/** Message Route */
Route::get('messages', [VendorMessageController::class, 'index'])->name('messages.index');
Route::post('send-message', [VendorMessageController::class, 'sendMessage'])->name('send-message');
Route::get('get-messages', [VendorMessageController::class, 'getMessages'])->name('get-messages');

/**
 * Vendor Shop Profile Routes
 */
Route::resource('shop-profile', VendorShopProfileController::class);

/**
 * Vendor Product Routes
 */
Route::put('product/change-status', [VendorProductController::class, 'changeStatus'])
    ->name('product.change-status');
Route::get('product/get-subcategories', [VendorProductController::class, 'getSubcategories'])
    ->name('product.get-subcategories');
Route::get('product/get-child-categories', [VendorProductController::class, 'getChildCategories'])
    ->name('product.get-child-categories');
Route::resource('products', VendorProductController::class);

/**
 * Vendor Products Image Gallery Routes
 */
Route::resource('products-image-gallery', VendorProductImageGalleryController::class);

/**
 * Vendor Products Variant Routes
 */
Route::put('products-variant/change-status', [VendorProductVariantController::class, 'changeStatus'])
    ->name('products-variant.change-status');
Route::resource('products-variant', VendorProductVariantController::class);

/**
 * Products Variant Option Routes
 */
Route::put('products-variant-option/change-status', [VendorProductVariantOptionController::class, 'changeStatus'])
    ->name('products-variant-option.change-status');
Route::put('products-variant-option/change-is-default', [VendorProductVariantOptionController::class, 'changeIsDefault'])
    ->name('products-variant-option.change-is-default');
Route::get('products-variant-option/{productId}/{variantId}', [VendorProductVariantOptionController::class, 'index'])
    ->name('products-variant-option.index');
Route::get('products-variant-option/create/{productId}/{variantId}',
    [VendorProductVariantOptionController::class, 'create'])->name('products-variant-option.create');
Route::post('products-variant-option', [VendorProductVariantOptionController::class, 'store'])
    ->name('products-variant-option.store');
Route::get('products-variant-option-edit/{variantOptionId}', [VendorProductVariantOptionController::class, 'edit'])
    ->name('products-variant-option.edit');
Route::put('products-variant-option-update/{variantOptionId}', [VendorProductVariantOptionController::class, 'update'])
    ->name('products-variant-option.update');
Route::delete('products-variant-option/{variantOptionId}', [VendorProductVariantOptionController::class, 'destroy'])
    ->name('products-variant-option.destroy');

/**
 * Orders Route
 */
Route::get('order/change-order-status', [VendorOrderController::class, 'changeOrderStatus'])
    ->name('order.change-order-status');
Route::get('orders', [VendorOrderController::class, 'index'])->name('orders.index');
Route::get('orders/show/{id}', [VendorOrderController::class, 'show'])->name('orders.show');

/** Reviews route */
Route::get('reviews', [VendorProductReviewController::class, 'index'])->name('reviews.index');

/** Withdraw route */
Route::get('withdraw-request/{id}', [VendorWithdrawController::class, 'showRequest'])->name('withdraw-request.show');

Route::resource('withdraw', VendorWithdrawController::class);
