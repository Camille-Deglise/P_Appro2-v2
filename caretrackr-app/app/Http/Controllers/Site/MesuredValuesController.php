<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PatientController;

use App\Http\Requests\MesuredValuesRequest;
use App\Models\MesuredValue;
use App\Models\Patient;
use App\Charts\MesuresChart;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class MesuredValuesController extends Controller
{
    public function addMesures(MesuredValuesRequest $request, $id) 
    {
        
        $validatedMesures = $request->validated();

        $patient = Patient::find($id);
        
        MesuredValue::create($validatedMesures);

        return redirect()->route('site.show', ['id' => $patient->id])->with('success', 'Mesures ajoutées avec succès.');

    }

    public function temperatureChart($mesures)
    {
        //Vérification que les mesures de température contiennent minimum 3 valeurs
        if($mesures->pluck('temperature')->count() < 3)
        {
            return "Minimum 3 valeurs nécessaires pour générer un graphique";
        }
        //Vérification que si les mesures de températures sont vides
        if($mesures->pluck('temperature')->isEmpty())
        {
            return null;
        }

        //Création nouveau graphique
        $tempChart = new MesuresChart;

        //Axe X contenant les dates 
        $dates = $mesures->pluck('mesured_at');

        //Axe Y contenant les températures
        $temperatures = $mesures->pluck('temperature');

        //Association des axes X Y pour le graphique
        $tempChart->labels($dates);
        $tempChart->dataset('Températures', 'line', $temperatures)->backgroundColor('rgba(255, 99, 132, 0.2)');
        return $tempChart;
    }
    

}
