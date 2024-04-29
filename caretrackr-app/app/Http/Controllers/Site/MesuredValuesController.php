<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\MesuredValuesRequest;
use App\Models\MesuredValue;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class MesuredValuesController extends Controller
{
    public function addMesures(MesuredValuesRequest $request, $id) 
    {
        //dd($request);
        
        $validatedMesures = $request->validated();
        $validatedMesures['patient_id'] = $id; 
        

        $patient = Patient::find($id);
        $serviceInfo = $patient->services()->wherePivot('patient_id', $id)->first();
        //dd($patient);
        MesuredValue::create($validatedMesures);

        return view('site.show', [
            'patient'=>$patient,
            'serviceInfo' =>$serviceInfo
            ])->with('success', 'Mesures ajoutées avec succès.');

    }
}
