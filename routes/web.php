<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::post('/login', function (Request $request) {
    if (Auth::attempt($request->only('email', 'password'))) {
        $request->session()->regenerate();
        if (auth()->user()->is_admin) { return redirect()->route('admin.dashboard'); }
        return redirect('/');
    }
    return back()->withErrors(['email' => 'Email atau password salah.']);
});

Route::post('/register', function (Request $request) {
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
    ]);
    $user = \App\Models\User::create($data);
    Auth::login($user);
    return redirect('/');
});

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

Route::get('/', function () {
    $products = \App\Models\Product::latest()->get();
    return view('home.index', compact('products'));
})->name('home');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

Route::middleware('not.admin')->group(function () {
    Route::get('/about', function () { return view('about'); })->name('about');
    Route::get('/login', function () { return view('auth.login'); })->name('login');
    Route::get('/register', function () { return view('auth.register'); })->name('register');

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/categories', function () { return view('categories.index'); })->name('categories.index');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/store', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/konfirmasi/sukses', function () { return view('konfirmasi.sukses'); })->name('konfirmasi.sukses');
    Route::get('/konfirmasi/gagal', function () { return view('konfirmasi.gagal'); })->name('konfirmasi.gagal');
});

Route::middleware(['auth', 'not.admin'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/order/{id}', [ProfileController::class, 'show'])->name('profile.show');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/pesanan', [AdminController::class, 'orders'])->name('admin.orders');
    Route::get('/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/store', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
});