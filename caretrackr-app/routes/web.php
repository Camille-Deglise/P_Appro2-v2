<?php

use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\ImportController;
use App\Http\Controllers\Site\PatientController;
use App\Http\Controllers\Site\SettingsController;
use App\Models\Patient;
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
/*-----------------------------------------------------------------------------*/

/*Route qui envoie l'email de vérification*/
Route::post('/email/verification-notification', function (Request $request)
{
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware('auth')->name('verification.send');

/* Route qui vérifie si l'email est validé */
Route::get('/email/verify({id}/{hash}', [VerificationController::class,'verify'])
->middleware('signed')->name('verification.verify');

/*-------------------------------------------------------------------------------------------*/
/*Route pour la page de connexion */
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'doLogin']);
Route::delete('/logout', [LoginController::class,'logout'])
->middleware('auth')
->name('logout');

/*--------------------------------------------*/
/*Route  de redirection sur la page home du site quand l'utilisateur est connecté */
Route::get('/home',  [HomeController::class, 'index'])->name('home');


/*--------------------------Routes pour les modifications de l'utilisateur------------------ */
Route::get('/settings', [SettingsController::class,'showSettings'])->name('settings');


/*-----------Routes gérant le CRUD pour le Patient------------------------------------- */
Route::resource('patient', PatientController::class)->except('destroy');
Route::get('/patients/{patient}/disable', [PatientController::class, 'disable'])->name('disable');
Route::post('/patients/{patient}/deactivated', [PatientController::class, 'deactivated'])->name('deactivated');

/*-----------------Route gérant l'import de données -------------------------------------*/
Route::get('/import', [ImportController::class, 'showForm'])->name('import.showForm');
Route::post('/import/process', [ImportController::class, 'process'])->name('import.process');