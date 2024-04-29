<?php


use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\AdminListController;
use App\Http\Controllers\Backend\BlogCategoryController;
use App\Http\Controllers\Backend\BlogCommentController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\CodSettingController;
use App\Http\Controllers\Backend\ManageUserController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminReviewController;
use App\Http\Controllers\Backend\AdminVendorProfileController;
use App\Http\Controllers\Backend\AdvertisementController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\CustomerListController;
use App\Http\Controllers\Backend\FlashSaleController;
use App\Http\Controllers\Backend\FooterGridThreeController;
use App\Http\Controllers\Backend\FooterGridTwoController;
use App\Http\Controllers\Backend\FooterInfoController;
use App\Http\Controllers\Backend\FooterSocialController;
use App\Http\Controllers\Backend\HomePageSettingController;
use App\Http\Controllers\Backend\MessageController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\PaymentSettingController;
use App\Http\Controllers\Backend\PaypalSettingController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductImageGalleryController;
use App\Http\Controllers\Backend\ProductVariantController;
use App\Http\Controllers\Backend\ProductVariantOptionController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SellerProductController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\ShippingRuleController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubcategoryController;
use App\Http\Controllers\Backend\SubscribersController;
use App\Http\Controllers\Backend\TermsAndConditionController;
use App\Http\Controllers\Backend\TransactionController;
use App\Http\Controllers\Backend\VendorApplicationController;
use App\Http\Controllers\Backend\VendorConditionController;
use App\Http\Controllers\Backend\VendorListController;
use App\Http\Controllers\Backend\WithdrawController;
use App\Http\Controllers\Backend\WithdrawMethodController;
use Illuminate\Support\Facades\Route;

/**
 * Dashboard Routes
 */
Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

/**
 * Profile Routes
 */
Route::get('profile', [ProfileController::class, 'index'])
    ->name('profile');
Route::post('profile/update', [ProfileController::class, 'updateProfile'])
    ->name('profile.update');
Route::post('profile/update/password', [ProfileController::class, 'updatePassword'])
    ->name('password.update');

/**
 * Slider Routes
 */
Route::put('slider/change-status', [SliderController::class, 'changeStatus'])
    ->name('slider.change-status');
Route::resource('slider', SliderController::class);

/**
 * Category Routes
 */
Route::put('category/change-status', [CategoryController::class, 'changeStatus'])
    ->name('category.change-status');
Route::resource('category', CategoryController::class);

/**
 * Subcategory Routes
 */
Route::put('subcategory/change-status', [SubcategoryController::class, 'changeStatus'])
    ->name('subcategory.change-status');
Route::resource('subcategory', SubcategoryController::class);

/**
 * Child Category Routes
 */
Route::put('child-category/change-status', [ChildCategoryController::class, 'changeStatus'])
    ->name('child-category.change-status');
Route::get('get-subcategories', [ChildCategoryController::class, 'getSubcategories'])
    ->name('get-subcategories');
Route::resource('child-category', ChildCategoryController::class);

/**
 * Brand Routes
 */
Route::put('brand/change-status', [BrandController::class, 'changeStatus'])
    ->name('brand.change-status');
Route::put('brand/change-is-featured', [BrandController::class, 'changeIsFeatured'])
    ->name('brand.change-is-featured');
Route::resource('brand', BrandController::class);

/**
 * Vendor Profile Routes
 */
Route::resource('vendor-profile', AdminVendorProfileController::class);

/**
 * Products Routes
 */
Route::put('product/change-status', [ProductController::class, 'changeStatus'])
    ->name('product.change-status');
Route::get('product/get-subcategories', [ProductController::class, 'getSubcategories'])
    ->name('product.get-subcategories');
Route::get('product/get-child-categories', [ProductController::class, 'getChildCategories'])
    ->name('product.get-child-categories');
Route::resource('products', ProductController::class);

/**
 * Products Image Gallery Routes
 */
Route::resource('products-image-gallery', ProductImageGalleryController::class);

/**
 * Products Variant Routes
 */
Route::put('products-variant/change-status', [ProductVariantController::class, 'changeStatus'])
    ->name('products-variant.change-status');
Route::resource('products-variant', ProductVariantController::class);

/**
 * Products Variant Option Routes
 */
Route::put('products-variant-option/change-status', [ProductVariantOptionController::class, 'changeStatus'])
    ->name('products-variant-option.change-status');
Route::put('products-variant-option/change-is-default', [ProductVariantOptionController::class, 'changeIsDefault'])
    ->name('products-variant-option.change-is-default');
Route::get('products-variant-option/{productId}/{variantId}', [ProductVariantOptionController::class, 'index'])
    ->name('products-variant-option.index');
Route::get('products-variant-option/create/{productId}/{variantId}',
    [ProductVariantOptionController::class, 'create'])->name('products-variant-option.create');
Route::post('products-variant-option', [ProductVariantOptionController::class, 'store'])
    ->name('products-variant-option.store');
Route::get('products-variant-option-edit/{variantOptionId}', [ProductVariantOptionController::class, 'edit'])
    ->name('products-variant-option.edit');
Route::put('products-variant-option-update/{variantOptionId}', [ProductVariantOptionController::class, 'update'])
    ->name('products-variant-option.update');
Route::delete('products-variant-option/{variantOptionId}', [ProductVariantOptionController::class, 'destroy'])
    ->name('products-variant-option.destroy');

/** reviews routes */
Route::get('reviews', [AdminReviewController::class, 'index'])->name('reviews.index');
Route::put('reviews/change-status', [AdminReviewController::class, 'changeStatus'])
    ->name('reviews.change-status');

/**
 * Seller Product Routes
 */
Route::put('seller-products/change-status', [SellerProductController::class, 'changeStatus'])
    ->name('seller-products.change-status');
Route::put('seller-products/change-is-approved', [SellerProductController::class, 'changeIsApproved'])
    ->name('seller-products.change-is-approved');
Route::get('seller-products', [SellerProductController::class, 'index'])->name('seller-products.index');
Route::get('seller-products/pending', [SellerProductController::class, 'pendingProducts'])
    ->name('seller-products.pending');

/**
 * Flash Sale Routes
 */
Route::put('flash-sale/change-status', [FlashSaleController::class, 'changeStatus'])
    ->name('flash-sale.change-status');
Route::put('flash-sale/change-show-at-home', [FlashSaleController::class, 'changeShowAtHome'])
    ->name('flash-sale.change-show-at-home');
Route::get('flash-sale', [FlashSaleController::class, 'index'])->name('flash-sale.index');
Route::put('flash-sale', [FlashSaleController::class, 'update'])->name('flash-sale.update');
Route::post('flash-sale/add-product', [FlashSaleController::class, 'addProduct'])
    ->name('flash-sale.add-product');
Route::delete('flash-sale/{flashSaleId}', [FlashSaleController::class, 'destroy'])
    ->name('flash-sale.destroy');

/**
 * Coupon Routes
 */
Route::put('coupons/change-status', [CouponController::class, 'changeStatus'])
    ->name('coupons.change-status');
Route::resource('coupons', CouponController::class);

/**
 * Shipping Rule Routes
 */
Route::put('shipping-rules/change-status', [ShippingRuleController::class, 'changeStatus'])
    ->name('shipping-rules.change-status');
Route::resource('shipping-rules', ShippingRuleController::class);

/**
 * Orders Routes
 */
Route::get('order/change-order-status', [OrderController::class, 'changeOrderStatus'])
    ->name('order.change-order-status');
Route::get('order/change-payment-status', [OrderController::class, 'changePaymentStatus'])
    ->name('order.change-payment-status');
Route::get('order/pending', [OrderController::class, 'pendingOrders'])->name('order-pending');
Route::get('order/processed-and-ready-to-ship', [OrderController::class, 'processedAndReadyToShipOrders'])
    ->name('order-processed-and-ready-to-ship');
Route::get('order/dropped-off', [OrderController::class, 'droppedOffOrders'])->name('order-dropped-off');
Route::get('order/shipped', [OrderController::class, 'shippedOrders'])->name('order-shipped');
Route::get('order/out-for-delivery', [OrderController::class, 'outForDeliveryOrders'])
    ->name('order-out-for-delivery');
Route::get('order/delivered', [OrderController::class, 'deliveredOrders'])->name('order-delivered');
Route::get('order/cancelled', [OrderController::class, 'cancelledOrders'])->name('order-cancelled');

Route::resource('order', OrderController::class);

/**
 * Transaction Routes
 */
Route::get('transaction', [TransactionController::class, 'index'])->name('transaction');

/** Withdraw method route */
Route::resource('withdraw-method', WithdrawMethodController::class);
Route::get('withdraw', [WithdrawController::class, 'index'])->name('withdraw.index');
Route::get('withdraw/{id}', [WithdrawController::class, 'show'])->name('withdraw.show');
Route::put('withdraw/{id}', [WithdrawController::class, 'update'])->name('withdraw.update');

/** Message route */
Route::get('messages', [MessageController::class, 'index'])->name('messages.index');
Route::get('get-messages', [MessageController::class, 'getMessages'])->name('get-messages');
Route::post('send-message', [MessageController::class, 'sendMessage'])->name('send-message');

/**
 * Settings Routes
 */
Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
Route::put('settings/general/update', [SettingController::class, 'updateGeneralSetting'])
    ->name('settings.general.update');
Route::put('settings/email/update', [SettingController::class, 'emailConfigSettingUpdate'])
    ->name('settings.email.update');
Route::put('settings/logo/update', [SettingController::class, 'logoSettingUpdate'])
    ->name('settings.logo.update');
Route::put('pusher-setting-update', [SettingController::class, 'pusherSettingUpdate'])
    ->name('pusher-setting-update');

/**
 * Home Page Settings Routes
 */
Route::get('home-page-setting', [HomePageSettingController::class, 'index'])->name('home-page-setting');
Route::put('home-page-setting/popular-categories', [HomePageSettingController::class, 'updatePopularCategories'])
    ->name('home-page-setting.popular-categories');
Route::put('home-page-setting/category-product-slider',
    [HomePageSettingController::class, 'updateCategoryProductSlider'])
    ->name('home-page-setting.category-product-slider');

/** Blog routes */
Route::put('blog-category/change-status', [BlogCategoryController::class, 'changeStatus'])
    ->name('blog-category.change-status');
Route::resource('blog-category', BlogCategoryController::class);
Route::put('blog/change-status', [BlogController::class, 'changeStatus'])->name('blog.change-status');
Route::resource('blog', BlogController::class);
Route::get('blog-comments', [BlogCommentController::class, 'index'])->name('blog-comments.index');
Route::delete('blog-comments/{id}/destroy', [BlogCommentController::class, 'destroy'])
    ->name('blog-comments.destroy');

/** Subscribers route */
Route::get('subscribers', [SubscribersController::class, 'index'])->name('subscribers.index');
Route::delete('subscribers/{id}', [SubscribersController::class, 'destroy'])->name('subscribers.destroy');
Route::post('subscribers-send-mail', [SubscribersController::class, 'sendMail'])
    ->name('subscribers-send-mail');

/** Advertisement Routes */
Route::get('advertisement', [AdvertisementController::class, 'index'])
    ->name('advertisement.index');
Route::put('advertisement/homepage-banner-section-one',
    [AdvertisementController::class, 'homepageBannerSectionOne'])->name('homepage-banner-section-one');
Route::put('advertisement/homepage-banner-section-two',
    [AdvertisementController::class, 'homepageBannerSectionTwo'])->name('homepage-banner-section-two');
Route::put('advertisement/homepage-banner-section-three',
    [AdvertisementController::class, 'homepageBannerSectionThree'])->name('homepage-banner-section-three');
Route::put('advertisement/homepage-banner-section-four',
    [AdvertisementController::class, 'homepageBannerSectionFour'])->name('homepage-banner-section-four');
Route::put('advertisement/product-page-banner',
    [AdvertisementController::class, 'productPageBanner'])->name('product-page-banner');
Route::put('advertisement/cart-page-banner',
    [AdvertisementController::class, 'cartPageBanner'])->name('cart-page-banner');

/** Vendor request routes */
Route::get('vendor-applications', [VendorApplicationController::class, 'index'])
    ->name('vendor-applications.index');
Route::get('vendor-applications/{id}/show', [VendorApplicationController::class, 'show'])
    ->name('vendor-applications.show');
Route::put('vendor-applications/{id}/change-status', [VendorApplicationController::class, 'changeStatus'])
    ->name('vendor-applications.change-status');

/** customer list routes */
Route::get('customer', [CustomerListController::class, 'index'])->name('customer.index');
Route::put('customer/change-status', [CustomerListController::class, 'changeStatus'])
    ->name('customer.change-status');

/** admin list routes */
Route::get('admin-list', [AdminListController::class, 'index'])->name('admin-list.index');
Route::put('admin-list/change-status', [AdminListController::class, 'changeStatus'])
    ->name('admin-list.change-status');
Route::delete('admin-list/{id}', [AdminListController::class, 'destroy'])->name('admin-list.destroy');

/** manage user routes */
Route::get('manage-user', [ManageUserController::class, 'index'])->name('manage-user.index');
Route::post('manage-user', [ManageUserController::class, 'create'])->name('manage-user.create');

/** vendor list routes */
Route::get('vendor-list', [VendorListController::class, 'index'])->name('vendor-list.index');
Route::put('vendor-list/change-status', [VendorListController::class, 'changeStatus'])
    ->name('vendor-list.change-status');

/** vendor condition routes */
Route::get('vendor-condition', [VendorConditionController::class, 'index'])
    ->name('vendor-condition.index');
Route::put('vendor-condition/update', [VendorConditionController::class, 'update'])
    ->name('vendor-condition.update');

/** about routes */
Route::get('about', [AboutController::class, 'index'])->name('about.index');
Route::put('about/update', [AboutController::class, 'update'])->name('about.update');

/** terms and conditions routes */
Route::get('terms-and-conditions', [TermsAndConditionController::class, 'index'])
    ->name('terms-and-conditions.index');
Route::put('terms-and-conditions/update', [TermsAndConditionController::class, 'update'])
    ->name('terms-and-conditions.update');

/** footer routes */
Route::resource('footer-info', FooterInfoController::class);
Route::put('footer-socials/change-status', [FooterSocialController::class, 'changeStatus'])
    ->name('footer-socials.change-status');
Route::resource('footer-socials', FooterSocialController::class);

Route::put('footer-grid-two/change-status', [FooterGridTwoController::class, 'changeStatus'])
    ->name('footer-grid-two.change-status');
Route::put('footer-grid-two/change-title', [FooterGridTwoController::class, 'changeTitle'])
    ->name('footer-grid-two.change-title');
Route::resource('footer-grid-two', FooterGridTwoController::class);

Route::put('footer-grid-three/change-status', [FooterGridThreeController::class, 'changeStatus'])
    ->name('footer-grid-three.change-status');
Route::put('footer-grid-three/change-title', [FooterGridThreeController::class, 'changeTitle'])
    ->name('footer-grid-three.change-title');
Route::resource('footer-grid-three', FooterGridThreeController::class);

/**
 * Payment Setting Routes
 */
Route::get('payment-setting', [PaymentSettingController::class, 'index'])->name('payment-setting');
Route::resource('paypal-setting', PaypalSettingController::class);
Route::put('cod-setting/{id}', [CodSettingController::class, 'update'])->name('cod-setting.update');
