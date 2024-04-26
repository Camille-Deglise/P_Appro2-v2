<?php

namespace App\Http\Controllers\Site;
use App\Models\Patient;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    public function showMonitoring($id)
{  
    $patient = Patient::with('services')->find($id);

    // Vérifie si le patient existe
    if (!$patient) {
        // Redirige l'utilisateur ou affiche une erreur
        abort(404, 'Patient non trouvé');
    }
    $serviceInfo = $patient->services()->wherePivot('patient_id', $id)->first();

    // Passer les valeurs à la vue
    return view('site.monitoring', [
        'patient' => $patient,
        'serviceInfo' =>$serviceInfo

    ]);
}

    
}
