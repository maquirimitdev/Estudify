<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\ForgotPasswordManager;
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

Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::get("/login", [authController::class, 'login'])->name('login');
Route::post("/login", [authController::class, 'loginPost'])->name('login.post');
Route::get("/register", [authController::class, 'register'])->name('register');
Route::post("/register", [authController::class, 'registerPost'])->name('register.post');
Route::get("/logout", [authController::class, 'logout'])->name('logout');
Route::group(['middleware' => 'auth'], function(){
    Route::get('/profile', function(){
        return "Hi";
    });
});

Route::get('/forget-password', [ForgotPasswordManager::class, 'forgetpassword'])->name('forget.password');
Route::post('/forget-password', [ForgotPasswordManager::class, 'forgetpasswordpost'])->name('forget.password.post');
Route::get('/reset-password/{token}', [ForgotPasswordManager::class, 'resetpassword'])->name('reset.password');
Route::post('/reset-password', [ForgotPasswordManager::class, 'resetpasswordpost'])->name('reset.password.post');

