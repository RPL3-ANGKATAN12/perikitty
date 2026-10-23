<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ComplaintController as AdminComplaintController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FeedbackController as AdminFeedbackController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopCategoryController;
use App\Http\Middleware\RedirectAdminToDashboard;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home.index');
})->name('home');


/*
|--------------------------------------------------------------------------
| Products dan Kategori
|--------------------------------------------------------------------------
*/

Route::get('/produk', [ProductController::class, 'index'])
    ->name('products.index');

Route::get('/produk/{product}', [ProductController::class, 'show'])
    ->name('products.show');

Route::get('/kategori', [ShopCategoryController::class, 'index'])
    ->name('categories.index');


/*
|--------------------------------------------------------------------------
| Cart
|--------------------------------------------------------------------------
*/

Route::get('/keranjang', [CartController::class, 'index'])
    ->name('cart.index');

Route::post('/keranjang/tambah/{product}', [CartController::class, 'add'])
    ->name('cart.add');

Route::patch('/keranjang/ubah/{product}', [CartController::class, 'update'])
    ->name('cart.update');

Route::delete('/keranjang/hapus/{product}', [CartController::class, 'remove'])
    ->name('cart.remove');

Route::delete('/keranjang/kosongkan', [CartController::class, 'clear'])
    ->name('cart.clear');


/*
|--------------------------------------------------------------------------
| Pembeli (harus login, admin tidak boleh masuk)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', RedirectAdminToDashboard::class])->group(function () {

    Route::get('/checkout', [CheckoutController::class, 'create'])
        ->name('checkout.create');

    Route::post('/checkout', [CheckoutController::class, 'store'])
        ->name('checkout.store');

    Route::get('/pesanan', [OrderController::class, 'index'])
        ->name('orders.index');

    Route::get('/pesanan/{order}', [OrderController::class, 'show'])
        ->name('orders.show');

    Route::get('/pengaduan', [ComplaintController::class, 'index'])
        ->name('complaints.index');

    Route::post('/pengaduan', [ComplaintController::class, 'store'])
        ->name('complaints.store');

    Route::get('/saran', [FeedbackController::class, 'index'])
        ->name('feedback.index');

    Route::post('/saran', [FeedbackController::class, 'store'])
        ->name('feedback.store');

    Route::get('/profil', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profil', [ProfileController::class, 'update'])
        ->name('profile.update');

});


/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/register', [RegisterController::class, 'create'])
        ->name('register');

    Route::post('/register', [RegisterController::class, 'store'])
        ->name('register.store');

    Route::get('/login', [LoginController::class, 'create'])
        ->name('login');

    Route::post('/login', [LoginController::class, 'store'])
        ->name('login.store');

});


/*
|--------------------------------------------------------------------------
| User Logout
|--------------------------------------------------------------------------
*/

Route::post('/logout', LogoutController::class)
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/login', [AuthController::class, 'create'])
            ->name('login');

        Route::post('/login', [AuthController::class, 'store'])
            ->name('login.store');

        Route::middleware(['auth', 'admin'])->group(function () {

            Route::get('/dashboard', [DashboardController::class, 'index'])
                ->name('dashboard');

            Route::resource('categories', CategoryController::class);

            Route::resource('products', AdminProductController::class);

            Route::resource('orders', AdminOrderController::class)
                ->only(['index', 'show', 'update']);

            Route::resource('complaints', AdminComplaintController::class)
                ->only(['index', 'show', 'update']);

            Route::get('/feedback', [AdminFeedbackController::class, 'index'])
                ->name('feedback.index');

            Route::post('/logout', [AuthController::class, 'destroy'])
                ->name('logout');

        });

    });