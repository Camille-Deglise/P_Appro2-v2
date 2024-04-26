<?php

namespace App\Http\Controllers\Site;
use App\Http\Controllers\Controller;
use App\Models\MesuredValue;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
   // public function getNavbarPatients()
    //{
        //if(Auth::check())
        //{
           //  $user = Auth::user();
            //$patients = $user->patients;
            //return $patients;
                //}
            //return null;
       
   // }
   public function index()
   {
       // Récupère l'ID de l'utilisateur connecté
       $userId = Auth::id();
   
       // Récupère les 5 dernières mesures associées aux patients de l'utilisateur
       $mesures = MesuredValue::whereIn('patient_id', function($query) use ($userId) {
                                   $query->select('id')
                                         ->from('patients')
                                         ->where('user_id', $userId);
                               })
                               ->orderBy('mesured_at', 'desc')
                               ->take(5)
                               ->join('patients', 'mesured_values.patient_id', '=', 'patients.id')
                               ->select('mesured_values.*', 'patients.name as patient_name', 'patients.firstname as patient_firstname')
                               ->get();
   
       // Récupère les 5 derniers patients avec le statut de santé associés à l'utilisateur
       $patients = Patient::where('user_id', $userId)
                           ->orderBy('created_at', 'desc')
                           ->join('health_statuses', 'patients.health_status_id', '=', 'health_statuses.id')
                           ->select('patients.*', 'health_statuses.label as health_status_label')                  
                           ->get();
   
       return view('site.home', compact('patients', 'mesures'));
   }

}
