<?php

use App\Http\Controllers\PasswordController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\StaticPagesController;
use App\Http\Controllers\StatusesController;
use App\Http\Controllers\UserController;
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

Route::get('/', [StaticPagesController::class, 'home'])->name('home');
Route::get('/help', [StaticPagesController::class, 'help'])->name('help');
Route::get('/about', [StaticPagesController::class, 'about'])->name('about');



Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store'])->name('login');
Route::delete('/logout', [SessionController::class, 'destroy'])->name('logout');

//Route::get('/user/qq', [UserController::class, 'create'])->name('user.qq');
//Route::middleware('auth', expect)->group(function (){
Route::get('signup/confirm/{token}', [UserController::class, 'confirmEmail'])->name('confirm_email');
Route::resource('user', UserController::class);
//});

Route::get('password/reset', [PasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/request', [PasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('password/reset/{token}',[PasswordController::class,'showResetForm'])->name('password.reset');
Route::post('password/reset',[PasswordController::class,'reset'])->name('password.update');

Route::middleware('auth')->group(function () { //>prefix('ticket')->name('ticket.')-
    Route::resource('statuses', StatusesController::class)->only(['store', 'destroy']);
});
