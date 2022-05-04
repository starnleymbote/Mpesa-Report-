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
    Route::get('/daily-transactions', [PagesController::class,'dailyTransactions'])->name('daily.transactions');
    Route::get('/weekly-transactions', [PagesController::class,'weeklyTransactions'])->name('weekly.transactions');
    Route::get('/auth', [MpesaController::class,'authorization'])->name('auth');
    Route::post('/confirmation', [MpesaController::class,'mpesaData'])->name('validated.url');
    // Route::get('confirmation', function(Request $request){
        
    //    // $data = json_decode($request->getContent(),true);
    //     \Log::info("Hello");
    // });
    Route::get('/validation', [MpesaController::class,'validationUrl'])->name('validation.url');
    Route::get('/validation/url', [MpesaController::class,'registerUrl'])->name('register.url');
    //Route::get('/confirmation', [MpesaController::class,'confirmationUrl'])->name('confirmation.url');
    Route::get('/profile', [PagesController::class,'userProfile'])->name('user.profile');
    Route::get('/c2b', [MpesaController::class,'customerToBusiness'])->name('c2b');

    Route::post('change-password', [UserController::class, 'changePassword'])->name('change.password');

});



Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
