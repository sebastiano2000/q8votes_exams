<?php

use App\Http\Controllers\Auth\RegisterController;
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
    Route::get('/success',[RegisterController::class,'success'])->name('register.success');

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
