<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Récupère les 5 derniers patients avec le statut de santé
        $patients = Patient::latest()
                    ->take(5)
                    ->join('health_statuses', 'patients.health_status_id', '=', 'health_statuses.id')
                    ->select('patients.*', 'health_statuses.label as health_status_label')
                    ->get();
    
        return view('site.home', ['patients' => $patients]);
    }
    
}
