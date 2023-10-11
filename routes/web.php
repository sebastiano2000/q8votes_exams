<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});



Route::group(['prefix' => 'register'], function () {
    Route::post('/create', [RegisterController::class, 'create'])->name('register.create');
    Route::get('/verification', [RegisterController::class, 'verification'])->name('register.verification');
    Route::get('/success', [RegisterController::class, 'success'])->name('register.success');
    // Route::post('/save/verification', [RegisterController::class, 'verification'])->name('verification.save');
    // Route::get('/verify/verification', [RegisterController::class, 'verificationCheck'])->name('verification.check');
    // Route::get('/register-success', [RegisterController::class, 'registersucess'])->name('register.success.information');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Auth::routes();

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/admin');
    } else {
        return redirect('login');
    }
});
