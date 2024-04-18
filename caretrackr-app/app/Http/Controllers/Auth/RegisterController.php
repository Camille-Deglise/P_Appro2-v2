<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view("site.register");
    }

    public function storeDB(RegisterRequest $request)
    {
        //Reprendre les données de la requête validée dans le RegisterRequest
        $validatedData = $request ->validated();

        //Récupérer l'id du service ou créer un nouveau service avec son nom 
        $service = Service::firstOrCreate(['name' => $validatedData['service']]);


        $user = User::create([
            'name' => $validatedData['name'],
            'firstname' => $validatedData['firstname'],
            'email' => $validatedData['email'],
            'hashed_password' =>Hash::make($validatedData['hashed_password']),
            'service_id' => $service ->id
        ]);

            //permet d'effectuer un nouvel événement d'enregistrement (de base dans Laravel) du $user afin de pouvoir par 
            //après utiliser la vérification d'email. 
            event(new Registered($user));
            
            return redirect()->route("login")->with("success",
            "Votre inscription s'est bien effectuée. Vérifier votre lien par email pour pouvoir vous connecter");

    }
}
