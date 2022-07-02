<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\MpesaController;
use App\Http\Controllers\UserController;
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
    
    Route::get('/update/profile', [PagesController::class,'updateProfile'])->name('update.profile');
    Route::post('/store-update', [UserController::class,'updateProfile'])->name('store.update');
    
    Route::get('/daily-transactions', [PagesController::class,'dailyTransactions'])->name('daily.transactions');
    Route::get('/weekly-transactions', [PagesController::class,'weeklyTransactions'])->name('weekly.transactions');
    Route::get('/auth', [MpesaController::class,'authorization'])->name('auth');
    Route::post('/confirmation', [MpesaController::class,'mpesaData'])->name('validated.url');
    // Route::get('confirmation', function(Request $request){
        
    //    // $data = json_decode($request->getContent(),true);
    //     \Log::info("Hello");
    // });
    Route::get('/validation', [MpesaController::class,'validationUrl'])->name('validation.url');
    Route::post('/validation/url', [MpesaController::class,'registerUrl'])->name('register.url');
    //Route::get('/confirmation', [MpesaController::class,'confirmationUrl'])->name('confirmation.url');
    Route::get('/profile', [PagesController::class,'userProfile'])->name('user.profile');
    Route::post('/c2b', [MpesaController::class,'customerToBusiness'])->name('c2b');
    //Route::get('/simulate', [MpesaController::class,'simulate']);

    Route::get('update-password', [PagesController::class, 'updatePassword'])->name('update.password');
    Route::post('change-password', [UserController::class, 'changePassword'])->name('change.password');

});

//New Mpesa Routes

Route::get('register-urls', [MpesaController::class, 'registerURLs']);
Route::get('simulate', [MpesaController::class, 'simulateC2B']);



Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
