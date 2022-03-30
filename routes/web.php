<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\MpesaController;
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


Route::get('/', [PagesController::class,'index'])->name('index');
Route::get('/daily-transactions', [PagesController::class,'dailyTransactions'])->name('daily.transactions');
Route::get('/weekly-transactions', [PagesController::class,'weeklyTransactions'])->name('weekly.transactions');
Route::get('/auth', [MpesaController::class,'authorization'])->name('auth');
Route::get('/validation', [MpesaController::class,'validationUrl'])->name('validation.url');
Route::get('/validation/url', [MpesaController::class,'registerUrl'])->name('validationr.url');
// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/index', function () {
//     return view('index');
// });

// Route::get('/test', function () {
//     return view('test');
// });

// Route::get('/daily', function () {
//     return view('daily_transaction');
// });



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
