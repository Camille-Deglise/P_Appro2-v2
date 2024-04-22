<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use App\Models\User;

class VerificationController extends Controller
{
    public function verify(Request $request)
    {
        $user = User::find($request->route('id'));
        if (!$user) {
            return redirect()->route('login')->with('userNotFoud', 'Utilisateur non trouvé.');
        }
        if ($user->hasVerifiedEmail()) {
            return redirect()->route('login')->with('info', 'Votre e-mail est déjà vérifié.');
        }

            // Marquer l'e-mail comme vérifié dans la base de données
            $user->markEmailAsVerified();

            // Déclencher l'événement Verified
            event(new Verified($user));

            // Rediriger l'utilisateur vers la page de connexion avec un message de succès
            return redirect()->route('login')->with('success', 'Votre e-mail a été vérifié avec succès. Vous pouvez maintenant vous connecter.');
    }
}
