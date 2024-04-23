<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('home'); // Redirige vers la page home si déjà connecté
        }
        return view("auth.login");
    }
    public function logout()
    {
        Auth::logout();
        return to_route('login')->with('success','Vous êtes bien déconnecté');
    }
    public function doLogin(LoginRequest $request) {
        //Vérification des données avec méthode validated et enregistrement dans une variable
        $crendentials = $request->validated();
        
        //Condition d'autorisation pour la connexion 
        if (Auth::attempt($crendentials))     //Les identifiants entrés sont présents dans la db
        {
            $user = Auth::user();                   //L'utilisateur est authentifié dans une variable.

                if($user ->email_verified_at != null) //Si l'utilisateur a son email vérifié 
                {
                    $request ->session()->regenerate();
                    return redirect()->route('home');

                }
                else                                                    //Si l'email n'est pas vérifié, Déconnexion de l'utilisateur 
                {
                    Auth::logout();
                    return redirect()->route('login')->withErrors([
                        'email' => "Email non vérifié"                      //Affichage de l'erreur
                    ])->withInput($request->only('email'))->with('message','Veuillez vérifier votre e-mail pour pouvoir vous connecter.');
                }
        }
        return redirect()->route('login')->withErrors([                       //Les idenfitifants ne sont pas reconnus dans la db
            'email' => 'Identifiants incorrects'
        ])->withInput($request->only('email'))->with('message','Veuillez entrer des identifiants valides');
    }

}
