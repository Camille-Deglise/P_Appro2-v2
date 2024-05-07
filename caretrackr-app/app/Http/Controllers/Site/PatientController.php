<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeactivtedRequest;
use App\Http\Requests\PatientFormRequest;
use App\Models\Allergy;
use App\Models\HealthStatus;
use App\Models\MedicalHistory;
use App\Models\Medication;
use App\Models\Patient;
use aPP\Models\MesuredValue;
use App\Charts\MesuresChart;
use App\Util\NoChartData;


class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Vérifier si l'utilisateur est authentifié
        if (!auth()->check()) {
            // Rediriger vers la page de connexion ou afficher un message d'erreur
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour accéder à cette page.');
        }
    
        $patient = new Patient();
        
        // Récupérer l'utilisateur actuellement authentifié
        $user = auth()->user();
    
        // Vérifier si l'utilisateur a un service associé
        if (!$user->services) {
            // Rediriger vers une page d'erreur ou afficher un message indiquant que l'utilisateur n'a pas de service
            return redirect()->back()->with('error', 'Vous n\'avez pas de service associé. Veuillez contacter l\'administrateur.');
        }
    
        // Récupérer le service associé à l'utilisateur
        //$service = $user->services;
    
        // Récupérer les autres données nécessaires pour le formulaire
        $health_statuses_id = HealthStatus::all();
        $medications = Medication::all();
        $allergies = Allergy::all();
        $medical_histories = MedicalHistory::all();
    
        // Passer les données à la vue
        return view('site.create', [
            'patient' => $patient,
            'user' => $user,
            'health_statuses_id' => $health_statuses_id,
            'medications' => $medications,
            'allergies' => $allergies,
            'medical_histories' => $medical_histories
        ]);
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(PatientFormRequest $request)
    {
        
        $health_status_id = $request->input('health_status_id');
        $user_id = auth()->id();
        
        $validatedData = $request->validated();
        
        
        $validatedData['health_status_id'] = $health_status_id;
        $validatedData['user_id'] = $user_id;
        $service = auth()->user()->services;
       
        $patient = Patient::create($validatedData);
        
        $patient->services()->attach($service->id, 
        ['reason_hospitalization'=>$validatedData['reason_hospitalization'], 
        'date_entry'=>now()]);
        $patient->medical_histories()->attach($request->input('medical_history'));
        $patient->medications()->attach($request->input('medication'));
        $patient->allergies()->attach($request->input('allergy'));

        return redirect()->route('patient.show', ['patient'=>$patient->id])->with('success', 'Le nouveau patient a bien été ajouté');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $patient = Patient::with('services')->find($id);

        // Vérifie si le patient existe
        if (!$patient) {
            // Redirige l'utilisateur ou affiche une erreur
            abort(404, 'Patient non trouvé');
        }
        $serviceInfo = $patient->services()->wherePivot('patient_id', $id)->first();
        
        $mesures = $patient->mesured_values()
        ->orderBy('mesured_at', 'desc')
        ->get();
        
        
        $tempChart = app(MesuredValuesController::class)->temperatureChart($mesures);
        $satChart = app(MesuredValuesController::class)->saturationChart($mesures);
        $pulseChart = app(MesuredValuesController::class)->pulseChart($mesures);
        $bsChart = app(MesuredValuesController::class)->blood_sugarChart($mesures);
        $tensChart = app(MesuredValuesController::class)->tensionChart($mesures);

    

            // Passer les valeurs à la vue
            return view('site.show', [
                'patient' => $patient,
                'serviceInfo' =>$serviceInfo,
                'mesures' => $mesures,
                'tempchart' => $tempChart,
                'satchart' => $satChart,
                'pulsechart' => $pulseChart,
                'bschart' =>$bsChart,
                'tenschart' =>$tensChart,
             
            ]);
        }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        $patient = $patient->load('services');

        $health_statuses_id = HealthStatus::all();
        $medications = Medication::all();
        $allergies = Allergy::all();
        $medical_histories = MedicalHistory::all();

        return view('site.edit', [
            'patient' => $patient,
            'health_statuses_id' => $health_statuses_id,
            'medications' => $medications,
            'allergies' => $allergies,
            'medical_histories' => $medical_histories
        ]);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Patient $patient, PatientFormRequest $request)
    {
        $validatedData = $request->validated();
        $patient->update($validatedData);
        $service = auth()->user()->services;

        $patient->services()->sync($service->id, 
        ['reason_hospitalization'=>$validatedData['reason_hospitalization'], 
        'date_entry'=>now()]);
        $patient->medical_histories()->sync($request->input('medical_history'));
        $patient->medications()->sync($request->input('medication'));
        $patient->allergies()->sync($request->input('allergy'));

        return redirect()->route('patient.show', ['patient'=>$patient->id])->with('success', 'Les données du patient ont bien été modifiées');
    }

    /**
     * View form for disable patient 
     */
    public function disable(Patient $patient)
    {   
        $health_statuses = HealthStatus::whereIn('label', ['retour à domicile', 'transfert', 'décès'])->get();
       
        return view('site.deactivated', compact('patient', 'health_statuses'));
    }

    public function deactivated(Patient $patient, DeactivtedRequest $request)
    {
        $validatedData = $request->validated();

        // Mettre à jour les informations du patient
        $patient->update([
            'discharge_date' => $validatedData['discharge_date'],
            'health_status_id' => $validatedData['health_status_id'],
        ]);
    
        // Supprimer les liens avec les services et de l'utilisateur
        $patient->update(['user_id'=> null]);
        $patient->services()->detach();
    
        return redirect()->route('home')->with('success', 'Le patient a été désactivé de vos suivis');
    }
}
