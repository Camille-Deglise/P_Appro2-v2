<?php

namespace App\Http\Controllers\Site;
use App\Http\Controllers\Controller;
use App\Models\MesuredValue;
use App\Models\Patient;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $mesures = MesuredValue::orderBy('mesured_at', 'desc')
        ->take(5)
        ->join('patients', 'mesured_values.patient_id', '=', 'patients.id')
        ->select('mesured_values.*', 'patients.name as patient_name', 'patients.firstname as patient_firstname')
        ->get();

        
        // Récupère les 5 derniers patients avec le statut de santé
        $patients = Patient::orderBy('id', 'desc')
                    ->take(5)
                    ->join('health_statuses', 'patients.health_status_id', '=', 'health_statuses.id')
                    ->select('patients.*', 'health_statuses.label as health_status_label')                  
                    ->get();
    
        return view('site.home', ['patients' => $patients], ['mesures' => $mesures]);
    }
    
    public function mesures()
    {
        $mesures = MesuredValue::orderBy('id', 'desc')
                ->take(5)
                ->join('patients', 'mesured_values.patient_id', '=', 'patients.id')
                ->select('mesured_values.*', 'patients.name as patient_name')
                ->get();
        return view('site.home', ['mesures' => $mesures]);
    }
}
