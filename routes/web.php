<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\ChartJSController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
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

//TAMPILKAN
Route::get('/', function () {
    return view('viewLogin');
});
Route::get('home', [HomeController::class, 'list']);
Route::get('viewReport', [ChartJSController::class, 'viewReport']);

// LOGIN DAN SIGN IN
Route::get('viewProfile', [AuthController::class, 'showProfile']);
Route::get('viewRegister', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::get('viewLogin', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('viewRegister', [AuthController::class, 'viewRegister']);
Route::post('viewLogin', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// TRANSAKSI
// Route::get('nominal-transaction', [TransactionController::class, 'nominalTransaction'])->name('nominalTransaction');
Route::get('viewTransaction', [TransactionController::class, 'viewTransaction']);
Route::post('save-transaction', [TransactionController::class, 'saveTransaction']);
Route::get('list-transaction', [TransactionController::class, 'listTransaction']);
Route::delete('delete-transaction/{id}', [TransactionController::class, 'deleteTransaction']);
Route::get('edit-transaction/{id}', [TransactionController::class, 'editTransaction']);
Route::post('update-transaction/{id}', [TransactionController::class, 'updateTransaction']);

//WALLET
Route::get('viewWallet', function () {
    return view('viewWallet');
});
Route::post('save-wallet', [WalletController::class, 'saveWallet']);
Route::get('list-wallet', [WalletController::class, 'listWallet']);
Route::delete('delete-wallet/{id}', [WalletController::class, 'deleteWallet']);
Route::get('edit-wallet/{id}', [WalletController::class, 'editWallet']);
Route::post('update-wallet/{id}', [WalletController::class, 'updateWallet']);


// KETERANGAN
Route::get('viewCategory', function () {
    return view('viewCategory');
});
Route::post('save-category', [CategoryController::class, 'saveCategory']);
Route::get('list-category', [CategoryController::class, 'listCategory']);
Route::delete('delete-category/{id}', [CategoryController::class, 'deleteCategory']);
Route::get('edit-category/{id}', [CategoryController::class, 'editCategory']);
Route::post('update-category/{id}', [CategoryController::class, 'updateCategory']);