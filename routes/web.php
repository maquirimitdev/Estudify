<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\ForgotPasswordManager;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\TeachersController;
use App\Models\Teachers;
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

Route::get('/students-list', [StudentsController::class, 'studentindex'])->name('student.index');
Route::get('/add/student', [StudentsController::class, 'createstudent'])->name('create.student');
Route::post('/add/student', [StudentsController::class, 'createstudentpost'])->name('create.student.post');
Route::get('/student/{id}', [StudentsController::class, 'show'])->name('show.student');
Route::put('/student/{student}', [StudentsController::class, 'update'])->name('update.student');
Route::delete('/student/{student}', [StudentsController::class, 'destroy'])->name('destroy.student');




Route::get('/teachers-list', [TeachersController::class, 'teachersindex'])->name('teacher.index');
Route::get('/add/teacher', [TeachersController::class, 'createteacher'])->name('create.teacher');
Route::post('/add/teacher', [TeachersController::class, 'createteacherpost'])->name('create.teacher.post');
Route::get('/teacher/{id}', [TeachersController::class, 'show'])->name('show.teacher');
Route::put('/teacher/{teacher}', [TeachersController::class, 'update'])->name('update.teacher');
Route::delete('/teacher/{teacher}', [TeachersController::class, 'destroy'])->name('destroy.teacher');



Route::get("/login", [authController::class, 'login'])->name('login');
Route::post("/login", [authController::class, 'loginPost'])->name('login.post');
Route::get("/register", [authController::class, 'register'])->name('register');
Route::post("/register", [authController::class, 'registerPost'])->name('register.post');
Route::get("/logout", [authController::class, 'logout'])->name('logout');
Route::group(['middleware' => 'auth'], function(){
    Route::get('/profile', function(){
        return "Hello World";
    });
});

Route::get('/forget-password', [ForgotPasswordManager::class, 'forgetpassword'])->name('forget.password');
Route::post('/forget-password', [ForgotPasswordManager::class, 'forgetpasswordpost'])->name('forget.password.post');
Route::get('/reset-password/{token}', [ForgotPasswordManager::class, 'resetpassword'])->name('reset.password');
Route::post('/reset-password', [ForgotPasswordManager::class, 'resetpasswordpost'])->name('reset.password.post');

