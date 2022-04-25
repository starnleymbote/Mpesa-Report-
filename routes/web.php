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



// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware(['auth'])->group(function () {
    
    Route::get('/', [PagesController::class,'index'])->name('index');
    Route::get('/daily-transactions', [PagesController::class,'dailyTransactions'])->name('daily.transactions');
    Route::get('/weekly-transactions', [PagesController::class,'weeklyTransactions'])->name('weekly.transactions');
    Route::get('/auth', [MpesaController::class,'authorization'])->name('auth');
    Route::get('/validation', [MpesaController::class,'validationUrl'])->name('validation.url');
    Route::get('/validation/url', [MpesaController::class,'registerUrl'])->name('register.url');
    Route::get('/confirmation', [MpesaController::class,'confirmationUrl'])->name('confirmation.url');
    Route::get('/profile', [PagesController::class,'userProfile'])->name('user.profile');

});


Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
