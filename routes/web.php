<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Auth::routes(['register' => false]);
Route::get('logout', 'Auth\LoginController@logout', function () {
    return abort(404);
});

Auth::routes();


// -----------------------------login-----------------------------------------
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'authenticate']);
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// // ------------------------------register---------------------------------------
// Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');
// Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'storeUser'])->name('register');

// // -----------------------------forget password ------------------------------
// Route::get('forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'getEmail'])->name('forget-password');
// Route::post('forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'postEmail'])->name('forget-password');

// // -----------------------------reset password ------------------------------
// Route::get('reset-password/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'getPassword']);
// Route::post('reset-password', [App\Http\Controllers\Auth\ResetPasswordController::class, 'updatePassword']);

// ----------------------------- user userManagement ------------------------------
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
    Route::get('/users', [App\Http\Controllers\UserController::class, 'index']);
    Route::get('/users/new', [App\Http\Controllers\UserController::class, 'index']);
    Route::get('/users/filter', [App\Http\Controllers\UserController::class, 'filter']);
    Route::get('/users/{id}', [App\Http\Controllers\UserController::class, 'show']);
    Route::get('/users/edit/{$id}', [App\Http\Controllers\UserController::class, 'edit']);
    Route::post('/users/edit/{$id}', [App\Http\Controllers\UserController::class, 'save']);
    Route::get('/users/remove/{id}', [App\Http\Controllers\UserController::class, 'remove']);

    Route::get('/toot_users', [App\Http\Controllers\TootUserController::class, 'index']);
    Route::get('/toot_users/filter', [App\Http\Controllers\TootUserController::class, 'filter']);
});