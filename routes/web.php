<?php
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Product;
use App\Http\Livewire\Cart;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\CheckRole;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Auth::routes();
route::group(['middleware'=> 'auth','checkRole'], function(){
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('/kasir', Cart::class)->name('kasir')->middleware('auth', 'checkRole:kasir');
    Route::resource('/kasir/meja', MejaController::class)->middleware('auth', 'checkRole:kasir');
    Route::get('/cart/pay', [Cart::class, 'pay_transaction'])->name('payOrder');
    Route::get('/admin', [AdminController::class, 'index'])->name('admin','kasir','manajer')->middleware('auth', 'checkRole:admin');
    Route::resource('/manajer', ProductController::class)->middleware('auth', 'checkRole:manajer');
    // Route::get('/manajer', [ProductController::class, 'index'])->name('manajer')->middleware('auth', 'checkRole:manajer');
    // Route::get('/products', Product::class)->name('manajer')->middleware('auth', 'checkRole:manajer');
});

Route::get('/', [HomeController::class, 'index'])->name('home');



// route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');