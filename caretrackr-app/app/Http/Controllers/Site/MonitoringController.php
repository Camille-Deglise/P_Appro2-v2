<?php

namespace App\Http\Controllers\Site;
use App\Models\Patient;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    public function showMonitoring($id)
{  
    $patient = Patient::find($id);

    // Vérifie si le patient existe
    if (!$patient) {
        // Redirige l'utilisateur ou affiche une erreur
        abort(404, 'Patient non trouvé');
    }
    //$patient->with('')

    // Passer les valeurs à la vue
    return view('site.monitoring', [
        'patient' => $patient

    ]);
}

    
}
