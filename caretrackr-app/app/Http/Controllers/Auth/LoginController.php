<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Méthode d'affichage du formulaire de connexion ou 
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('home'); // Redirige vers la page home si déjà connecté
        }
        return view("auth.login");
    }


    /**
     * Méthode pour déconnecter l'utilisateur
     */
    public function logout()
    {
        Auth::logout();
        return to_route('login')->with('success','Vous êtes bien déconnecté');
    }



    /**
     * Méthode pour le login de l'utilisateur
     * Va vérifier si l'email de l'utilisateur est vérifié
     * Va vérifier si les crédentiels de l'utilisateur sont :
     * Reconnus dans la base de données
     * Valides 
     */
    public function doLogin(LoginRequest $request) {
        // Vérification des données avec méthode validated et enregistrement dans une variable
        $credentials = $request->validated();
        
        // Tentative de connexion
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if($user->email_verified_at != null) {
                // Utilisateur authentifié avec succès
                $request->session()->regenerate();
                return redirect()->route('home')->with('success', 'Vous êtes connecté avec succès.');
            } else {
                // Email non vérifié
                Auth::logout();
                return redirect()->route('login')->withErrors(['email' => "Email non vérifié"])->withInput($request->only('email'));
            }
        }
        
        // Vérification si l'email existe dans la base de données
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            // Email inexistant dans la base de données
            return redirect()->route('login')->withErrors(['email' => "Email inexistant"])->withInput($request->only('email'));
        }
        
        // Identifiants incorrects
        return redirect()->route('login')->withErrors(['email' => 'Identifiants incorrects'])->withInput($request->only('email'));
    }
    

}
