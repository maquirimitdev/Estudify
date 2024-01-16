<?php

use App\Http\Controllers\authController;
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
