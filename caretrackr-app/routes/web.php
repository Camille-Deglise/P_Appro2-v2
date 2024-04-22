<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Requests\LoginRequest;
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

/*Route qui envoie l'email de vérification*/
Route::post('/email/verification-notification', function (Request $request)
{
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware('auth')->name('verification.send');

/* Route qui vérifie si l'email est validé */
Route::get('/email/verify({id}/{hash}', 'App\Http\Controllers\Auth\VerificationController@verify')
->middleware('signed')->name('verification.verify');

/*Route pour la page de connexion */
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'doLogin']);