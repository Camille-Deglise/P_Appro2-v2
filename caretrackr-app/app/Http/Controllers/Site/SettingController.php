<?php

namespace App\Http\Controllers\Site;
use App\Models\User;
use App\Models\Service;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit()
    {
        // Vérifier si l'utilisateur est authentifié
        if (!auth()->check()) {
            // Rediriger vers la page de connexion ou afficher un message d'erreur
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour accéder à cette page.');
            }

        // Récupérer l'utilisateur actuellement authentifié
        $user = auth()->user();
    
        // Vérifier si l'utilisateur a un service associé
        if (!$user->services) {
            // Rediriger vers une page d'erreur ou afficher un message indiquant que l'utilisateur n'a pas de service
            return redirect()->back()->with('error', 'Vous n\'avez pas de service associé. Veuillez contacter l\'administrateur.');
        }

        // Récupérer le service associé à l'utilisateur
        $services = Service::all();

        return view('site.setting', 
        [
            'user' => $user,
            'services' => $services
        ]);
    }

    public function update(SettingRequest $request, User $user)
    {
        $user = User::findOrFail($request->user_id);

        $validatedData = $request->validated();

        $user->update($validatedData);

        return redirect()->route('setting.edit')->with('success', 'Vos données ont bien été modifiées');
    }
}
