<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\PatientFormRequest;
use App\Models\Allergy;
use App\Models\HealthStatus;
use App\Models\MedicalHistory;
use App\Models\Medication;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Models\Service;
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
        $patient = new Patient();
        $services = Service::all();
        $medications = Medication::all();
        $health_statuses = HealthStatus::all();
        $allergies = Allergy::all();
        $medical_histories = MedicalHistory::all();
        return view('site.create', 
        [   
            'patient' => $patient,
            'services'=>$services, 
            'health_statuses' =>$health_statuses,
            'medications'=>$medications,
            'allergies' => $allergies,
            'medical_histories' => $medical_histories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PatientFormRequest $request)
    {
        $patient =Patient::create($request->validated());
        $patient->services()->sync($request->validated('services'));
        $patient->medical_histories()->sync($request->validated('medical_histories'));
        $patient->medications()->sync($request->validated('medications'));
        $patient->allergies()->sync($request->validated('allergy'));
        return redirect()->route('monitoring')->with('success', 'Le nouveau patient a bien été ajouté');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
