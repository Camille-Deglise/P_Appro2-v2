<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view("site.login");
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
                    return view('home');

                }
                else                                                    //Si l'email n'est pas vérifié
                {
                    Auth::logout();
                    return redirect()->route('login')->withErrors([
                        'email' => "Email non vérifié"                      //Affichage de l'erreur
                    ]);
                }
        }
        return redirect()->route('login')->withErrors([                       //Les idenfitifants ne sont pas reconnus dans la db
            'email' => 'Identifiants incorrects'
        ]);
    }

}
