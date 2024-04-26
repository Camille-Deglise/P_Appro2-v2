<?php

namespace App\Http\Controllers\Site;
use Illuminate\Support\Facades\Auth;
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
        $health_statuses_id = HealthStatus::all();
        $allergies = Allergy::all();
        $medical_histories = MedicalHistory::all();

        return view('site.create', 
        [   
            'patient' => $patient,
            'services'=>$services, 
            'health_statuses_id' =>$health_statuses_id,
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
        //dd($request);
        $health_status_id = $request->input('health_status_id');
        $user_id = auth()->id();
        
        $validatedData = $request->validated();
        
        
        $validatedData['health_status_id'] = $health_status_id;
        $validatedData['user_id'] = $user_id;
        
        //dd($validatedData);
        $patient = Patient::create($validatedData);
        //dd($patient);
        $patient->services()->attach($request->input('service'), 
        ['reason_hospitalization'=>$validatedData['reason_hospitalization'], 
        'date_entry'=>now()]);
        $patient->medical_histories()->attach($request->input('medical_history'));
        $patient->medications()->attach($request->input('medication'));
        $patient->allergies()->attach($request->input('allergy'));

        return redirect()->route('monitoring', ['id'=>$patient->id])->with('success', 'Le nouveau patient a bien été ajouté');
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
