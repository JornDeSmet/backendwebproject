<?php

use App\Http\Controllers\{
    ProfileController,
    UserController,
    NewsController,
    FaqController,
    CategoryController,
    ContactController,
    AdminContactController,
    ProductController,
    CartController,
    CheckoutController,
    OrderController,
    OrderManagementController,
    ProductManagementController
};
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{news}', [NewsController::class, 'show'])->name('news.show');
Route::post('/news/{news}/comments', [NewsController::class, 'addComment'])->name('news.addComment');

Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');

Route::get('/shop', [ProductController::class, 'index'])->name('shop.index');
Route::get('/shop/{id}', [ProductController::class, 'show'])->name('shop.show');

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');

// Authenticated User Routes
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard')->middleware('verified');

    // Profile Management
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // Orders
    Route::get('/profile/orders', [OrderController::class, 'index'])->name('profile.orders');

    // Cart
    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('cart.index');
        Route::post('/add', [CartController::class, 'add'])->name('cart.add');
        Route::delete('/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
        Route::put('/update/{id}', [CartController::class, 'update'])->name('cart.update');
    });

    // Checkout
    Route::prefix('checkout')->group(function () {
        Route::get('/', [CheckoutController::class, 'createCheckoutSession'])->name('checkout');
        Route::get('/success', [CheckoutController::class, 'success'])->name('checkout.success');
        Route::get('/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');
    });
});

// Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {
    // User Management
    Route::prefix('users')->group(function () {
        Route::post('/', [UserController::class, 'store'])->name('users.store');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::patch('/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::patch('/{user}/toggle-admin', [UserController::class, 'toggleAdmin'])->name('users.toggle-admin');
    });

    // News Management
    Route::prefix('news')->group(function () {
        Route::post('/', [NewsController::class, 'store'])->name('news.store');
        Route::get('/{news}/edit', [NewsController::class, 'edit'])->name('news.edit');
        Route::put('/{news}', [NewsController::class, 'update'])->name('news.update');
        Route::delete('/{news}', [NewsController::class, 'destroy'])->name('news.destroy');
    });

    // FAQ Management
    Route::prefix('faq')->group(function () {
        Route::post('/', [FaqController::class, 'store'])->name('faqs.store');
        Route::put('/{faq}', [FaqController::class, 'update'])->name('faqs.update');
        Route::delete('/{faq}', [FaqController::class, 'destroy'])->name('faqs.destroy');
    });

    // Category Management
    Route::prefix('categories')->group(function () {
        Route::post('/', [CategoryController::class, 'store'])->name('categories.store');
        Route::put('/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    });

    // Admin Contact Management
    Route::prefix('admincontact')->group(function () {
        Route::get('/', [AdminContactController::class, 'index'])->name('admin-contact.index');
        Route::get('/{id}', [AdminContactController::class, 'show'])->name('admin-contact.show');
        Route::post('/{id}/reply', [AdminContactController::class, 'reply'])->name('admin-contact.reply');
    });

    // Product Management
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductManagementController::class, 'index'])->name('products.index');
        Route::get('/create', [ProductManagementController::class, 'create'])->name('products.create');
        Route::post('/', [ProductManagementController::class, 'store'])->name('products.store');
        Route::get('/{product}/edit', [ProductManagementController::class, 'edit'])->name('products.edit');
        Route::put('/{product}', [ProductManagementController::class, 'update'])->name('products.update');
        Route::delete('/{product}', [ProductManagementController::class, 'destroy'])->name('products.destroy');
    });

    // Order Management
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderManagementController::class, 'index'])->name('admin.orders.index');
        Route::get('/{order}', [OrderManagementController::class, 'show'])->name('admin.orders.show');
        Route::patch('/{order}/status', [OrderManagementController::class, 'updateStatus'])->name('admin.orders.updateStatus');
    });
});

require __DIR__.'/auth.php';
