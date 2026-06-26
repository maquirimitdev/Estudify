<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\ForgotPasswordManager;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\TeachersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuperAdminDashboardController;
use App\Http\Controllers\SuperCreateUserController;
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

    Route::middleware(['auth', 'role:SUP'])->group(function () {
    Route::get('/superadmin/dashboard', [SuperAdminDashboardController::class, 'index'])->name('superadmin.dashboard');
    Route::get('/superadmin/user-table/{role}', [SuperCreateUserController::class, 'roleTable'])
        ->name('superadmin.role_table');
    Route::get('/superadmin/user-table/{role}/create', [SuperCreateUserController::class, 'createUser'])
        ->name('superadmin.create_user');
    Route::post('/superadmin/user-table/{role}', [SuperCreateUserController::class, 'storeUser'])
        ->name('superadmin.store_user');
    Route::get('/superadmin/user-table/{user}/edit', [SuperCreateUserController::class, 'editUser'])
        ->name('superadmin.edit_user');
    Route::put('/superadmin/user-table/{user}', [SuperCreateUserController::class, 'updateUser'])
        ->name('superadmin.update_user');
    Route::delete('/superadmin/user-table/{user}', [SuperCreateUserController::class, 'deleteUser'])
        ->name('superadmin.delete_user');
});

Route::middleware(['auth', 'role:SUP'])->group(function () {
    Route::get('/superadmin/dashboard', [SuperAdminDashboardController::class, 'index'])->name('admin.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Route::middleware('auth')->group(function () {
    
//     // Main dashboard - redirects based on role
//     // Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    
//     // Role-specific dashboards
    
//     Route::get('/admin-dashboard', [AdminDashboardController::class, 'index'])
//         ->middleware('admin')
//         ->name('admin.dashboard');
    
//     Route::get('/teacher-dashboard', [TeacherDashboardController::class, 'index'])
//         ->middleware('teacher')
//         ->name('teacher.dashboard');
    
//     Route::get('/student-dashboard', [StudentDashboardController::class, 'index'])
//         ->middleware('student')
//         ->name('student.dashboard');
// });


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

