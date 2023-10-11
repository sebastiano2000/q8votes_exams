<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
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
    Route::post('/data', [RegisterController::class, 'create'])->name('register.create');
    Route::get('/verification', [RegisterController::class, 'verification'])->name('register.verification');
    Route::post('/store', [RegisterController::class, 'store'])->name('register.store');
    Route::get('/success', [RegisterController::class, 'success'])->name('register.success');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::group(['prefix' => 'forget-password'], function () {
    Route::get('/', [ResetPasswordController::class, 'index'])->name('forget-password.reset');
    Route::post('/data', [ResetPasswordController::class, 'create'])->name('forget-password.reset');
    Route::get('/verification', [ResetPasswordController::class, 'verification'])->name('forget-password.verification');
    Route::post('/check', [ResetPasswordController::class, 'check'])->name('forget-password.check');
    Route::post('/send', [ResetPasswordController::class, 'send'])->name('forget-password.send');
});

Auth::routes();

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/admin');
    } else {
        return redirect('login');
    }
});
