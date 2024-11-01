<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\UserRolesController;
use App\Http\Controllers\Login;
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

Route::get('/login', [UsersController::class, 'login'])->name('login');
Route::get('/register', [UsersController::class, 'register'])->name('register');

//Register
//Route::post('/register', [UsersController::class, 'store'])->name('store');



//OTP
Route::post('/register', [UsersController::class, 'sendOTP'])->name('sendOTP');
Route::get('/otp', [UsersController::class, 'verifyotp'])->name('verifyotp');
Route::post('/otp', [UsersController::class, 'verifysendotp'])->name('verifysendotp');


Route::get('/users', [UsersController::class, 'users'])->name('users');

//staff
Route::get('/index', [UsersController::class, 'index'])->name('index');
//admin ily iza
Route::get('/admin', [UsersController::class, 'admin'])->name('admin');



//edit
Route::get('editusers/{editusers}/edit', [UsersController::class, 'edit'])->name('edit');

//update
Route::put('updateusers/{updateusers}/update', [UsersController::class, 'update'])->name('update');

//delete
Route::delete('deleteusers/{delete}/delete', [UsersController::class, 'delete'])->name('delete');
//Iloveyou iza

//login
Route::post('/loginpost', [Login::class, 'loginpost'])->name('loginpost');

//logout
Route::get('/logout', [UsersController::class, 'logout'])->name('logout');

//addingrole
Route::post('/admin', [UserRolesController::class, 'addrole'])->name('addrole');


