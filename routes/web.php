<?php


use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\frontend\AboutController;
use App\Http\Controllers\frontend\CartController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\ProductController as SanphamProduct;
use App\Http\Controllers\frontend\ContactController as LienHeContact;

use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\BrandController;
use App\Http\Controllers\backend\BannerController;
use App\Http\Controllers\backend\MenuController;
use App\Http\Controllers\backend\ContactController;
use App\Http\Controllers\backend\FeedbackController;
use App\Http\Controllers\backend\OrderController;
use App\Http\Controllers\backend\PostController;
use App\Http\Controllers\backend\TopicController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\AuthController;
use App\Models\Feedback;
use App\Http\Controllers\frontend\CheckoutController;
use App\Http\Controllers\frontend\PaymentController;
use App\Http\Controllers\backend\StatisticController;
use App\Http\Controllers\backend\RevenueController;


Route::get('/',[HomeController::class, 'index'])->name('site.home');
Route::get('/san-pham',[SanphamProduct::class, 'index'])->name('site.product');
Route::get('/san-pham/tim-kiem',[SanphamProduct::class, 'search'])->name('site.product.search');
Route::get('/san-pham/{slug}',[SanphamProduct::class, 'detail'])->name('site.product.detail');
Route::get('/lien-he',[LienHeContact::class, 'index'])->name('site.contact');
Route::get('/gio-hang',[CartController::class,'index'])->name('site.cart');
// Routes cho bài viết
Route::get('/bai-viet', [App\Http\Controllers\frontend\PostController::class, 'index'])->name('site.post.index');
Route::get('/bai-viet/{slug}', [App\Http\Controllers\frontend\PostController::class, 'show'])->name('site.post.show');
// Route cho giỏ hàng
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.addToCart');
Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.removeFromCart');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.updateCart');
Route::get('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clearCart');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/ve-chung-toi',[AboutController::class,'index'])->name('site.about');


Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function() {
    Route::get('/', [DashboardController::class,'index'])->name('admin.dashboard');
    Route::prefix('product')->group(function(){
        Route::get('trash',[ProductController::class,'trash'])->name('product.trash');
        Route::get('delete/{product}',[ProductController::class,'delete'])->name('product.delete');
        Route::get('restore/{product}',[ProductController::class,'restore'])->name('product.restore');
        Route::get('status/{product}',[ProductController::class,'status'])->name('product.status');
        Route::get('search',[ProductController::class,'search'])->name('product.search');
        Route::get('{product}/store',[ProductController::class,'storeManagement'])->name('product.store');
        Route::put('{product}/store',[ProductController::class,'updateStore'])->name('product.store.update');
    });
    Route::resource('product',ProductController::class);

    Route::prefix('category')->group(function(){
        Route::get('trash',[CategoryController::class,'trash'])->name('category.trash');
        Route::get('delete/{category}',[CategoryController::class,'delete'])->name('category.delete');
        Route::put('restore/{category}',[CategoryController::class,'restore'])->name('category.restore');
        Route::get('status/{category}',[CategoryController::class,'status'])->name('category.status');
    });
    Route::resource('category',CategoryController::class);

    Route::prefix('brand')->group(function(){
        Route::get('trash',[BrandController::class,'trash'])->name('brand.trash');
        Route::get('delete/{brand}',[BrandController::class,'delete'])->name('brand.delete');
        Route::get('restore/{brand}',[BrandController::class,'restore'])->name('brand.restore');
        Route::get('status/{brand}',[BrandController::class,'status'])->name('brand.status');
    });
    Route::resource('brand',BrandController::class);

    Route::prefix('banner')->group(function(){
        Route::get('trash',[BannerController::class,'trash'])->name('banner.trash');
        Route::get('delete/{banner}',[BannerController::class,'delete'])->name('banner.delete');
        Route::get('restore/{banner}',[BannerController::class,'restore'])->name('banner.restore');
        Route::get('status/{banner}',[BannerController::class,'status'])->name('banner.status');
    });
    Route::resource('banner',BannerController::class);

    Route::prefix('menu')->group(function(){
        Route::get('trash',[MenuController::class,'trash'])->name('menu.trash');
        Route::get('delete/{menu}',[MenuController::class,'delete'])->name('menu.delete');
        Route::get('restore/{menu}',[MenuController::class,'restore'])->name('menu.restore');
        Route::get('status/{menu}',[MenuController::class,'status'])->name('menu.status');
    });
    Route::resource('menu',MenuController::class);

    Route::prefix('contact')->group(function(){
        Route::get('trash',[ContactController::class,'trash'])->name('contact.trash');
        Route::get('delete/{contact}',[ContactController::class,'delete'])->name('contact.delete');
        Route::get('restore/{contact}',[ContactController::class,'restore'])->name('contact.restore');
        Route::get('status/{contact}',[ContactController::class,'status'])->name('contact.status');
    });
    Route::resource('contact',ContactController::class);

    Route::prefix('order')->group(function(){
        Route::get('trash',[OrderController::class,'trash'])->name('order.trash');
        Route::get('delete/{order}',[OrderController::class,'delete'])->name('order.delete');
        Route::get('restore/{order}',[OrderController::class,'restore'])->name('order.restore');
        Route::get('status/{order}',[OrderController::class,'status'])->name('order.status');
    });
    Route::resource('order',OrderController::class);

    Route::prefix('post')->group(function(){
        Route::get('trash',[PostController::class,'trash'])->name('post.trash');
        Route::get('delete/{post}',[PostController::class,'delete'])->name('post.delete');
        Route::get('restore/{post}',[PostController::class,'restore'])->name('post.restore');
        Route::get('status/{post}',[PostController::class,'status'])->name('post.status');
        Route::get('search',[PostController::class,'search'])->name('post.search');
    });
    Route::resource('post',PostController::class);

    Route::prefix('topic')->group(function(){
        Route::get('trash',[TopicController::class,'trash'])->name('topic.trash');
        Route::get('delete/{topic}',[TopicController::class,'delete'])->name('topic.delete');
        Route::get('restore/{topic}',[TopicController::class,'restore'])->name('topic.restore');
        Route::get('status/{topic}',[TopicController::class,'status'])->name('topic.status');
    });
    Route::resource('topic',TopicController::class);

    Route::prefix('user')->group(function(){
        Route::get('trash',[UserController::class,'trash'])->name('user.trash');
        Route::get('delete/{user}',[UserController::class,'delete'])->name('user.delete');
        Route::get('restore/{user}',[UserController::class,'restore'])->name('user.restore');
        Route::get('status/{user}',[UserController::class,'status'])->name('user.status');
    });
    Route::resource('user',UserController::class);

    Route::prefix('feedback')->group(function(){
        Route::get('trash',[FeedbackController::class,'trash'])->name('feedback.trash');
        Route::get('delete/{feedback}',[FeedbackController::class,'delete'])->name('feedback.delete');
        Route::get('restore/{feedback}',[FeedbackController::class,'restore'])->name('feedback.restore');
        Route::get('status/{feedback}',[FeedbackController::class,'status'])->name('feedback.status');
    });
    Route::resource('feedback',FeedbackController::class);
    
    // Productsale routes
    Route::get('productsale/trash', [App\Http\Controllers\backend\ProductsaleController::class, 'trash'])->name('productsale.trash');
    Route::get('productsale/restore/{productsale}', [App\Http\Controllers\backend\ProductsaleController::class, 'restore'])->name('productsale.restore');
    Route::get('productsale/delete/{productsale}', [App\Http\Controllers\backend\ProductsaleController::class, 'delete'])->name('productsale.delete');
    Route::resource('productsale', App\Http\Controllers\backend\ProductsaleController::class);

    // Routes cho bài viết
    Route::get('/post', [PostController::class, 'index'])->name('post.index');
    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/post/store', [PostController::class, 'store'])->name('post.store');
    Route::get('/post/edit/{post}', [PostController::class, 'edit'])->name('post.edit');
    Route::put('/post/update/{post}', [PostController::class, 'update'])->name('post.update');
    Route::delete('/post/delete/{post}', [PostController::class, 'destroy'])->name('post.delete');
    Route::get('/post/status/{post}', [PostController::class, 'status'])->name('post.status');

    Route::delete('/admin/product/image/{id}', [ProductController::class, 'deleteImage'])->name('product.image.delete');
    Route::get('/revenue', [RevenueController::class, 'index'])->name('revenue.index');


}); 


Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

Route::post('/payment/create', [PaymentController::class, 'createPayment'])->name('payment.create');
Route::get('/payment/return', [PaymentController::class, 'returnPayment'])->name('payment.return');

Route::get('/chinh-sach-doi-tra', [App\Http\Controllers\frontend\ReturnPolicyController::class, 'index'])->name('return.policy');
Route::get('/chinh-sach-van-chuyen', [App\Http\Controllers\frontend\ShippingPolicyController::class, 'index'])->name('shipping.policy');
Route::get('/chinh-sach-bao-hanh', [App\Http\Controllers\frontend\WarrantyPolicyController::class, 'index'])->name('warranty.policy');

Route::get('/huong-dan-mua-hang', [App\Http\Controllers\frontend\BuyingGuideController::class, 'index'])->name('buying.guide');

// Google Login Routes
Route::get('auth/google', [App\Http\Controllers\Auth\GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [App\Http\Controllers\Auth\GoogleController::class, 'handleGoogleCallback'])->name('google.callback');

// Facebook Login Routes
Route::get('auth/facebook', [App\Http\Controllers\Auth\FacebookController::class, 'redirectToFacebook'])->name('facebook.login');
Route::get('auth/facebook/callback', [App\Http\Controllers\Auth\FacebookController::class, 'handleFacebookCallback'])->name('facebook.callback');





