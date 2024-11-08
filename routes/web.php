<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\ChatController;


    // Routes handled by FrontEndController
    Route::controller(FrontEndController::class)->group(function () {
        Route::get('/', 'homePage')->name('home-page');
        Route::get('/product/{id}','showProductDetail')->name('product.detail');
        Route::get('/products/search', 'search')->name('product.search');

        Route::get('/shop', 'shopPage')->name('shop');
        Route::get('/privacy-policy', 'privacy')->name('privacy.policy');
        Route::get('/terms-of-use', 'terms')->name('terms.use');

        Route::get('/shopdetail', 'shopDetailPage')->name('shopdetail');
        Route::get('/cart', 'cartPage')->name('cart');
        Route::get('/checkout', 'checkoutPage')->name('checkout');
        Route::get('/contact', 'contactPage')->name('contact');

    });

    Route::middleware('auth')->group(function () {
        Route::get('/chat/{seller}', [ChatController::class, 'showChat'])->name('chat.withSeller');
        Route::post('/chat/{seller}/send', [ChatController::class, 'sendMessage'])->name('chat.sendMessage');
    });
    

    

    // Example static views
    Route::view('/example-page', 'example-page');
    Route::view('/example-auth', 'example-auth');
    Route::view('example-frontend', 'example-frontend');
    
