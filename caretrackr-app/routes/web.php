<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Models\User;
use Illuminate\Http\Request;

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

/*Route pour la page d'inscription */
Route::get('/register',  [RegisterController::class, 'showRegistrationForm']) ->name('register');
Route::post('/register', [RegisterController::class,'storeDB']);

/*Route pour la page de connexion */
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');