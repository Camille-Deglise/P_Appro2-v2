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
    
    public function saturationChart($mesures)
    {
        //Création nouveau graphique
        $satChart = new MesuresChart;

        //Axe X contenant les dates 
        $dates = $mesures->pluck('mesured_at');

        //Axe Y contenant les températures
        $saturation = $mesures->pluck('oxygen_saturation');

        //Association des axes X Y pour le graphique
        $satChart->labels($dates);
        $satChart->dataset('Saturation O2', 'line', $saturation)->backgroundColor('rgba(255, 99, 132, 0.2)');
        return $satChart;
    }

    public function pulseChart($mesures)
    {
        //Création nouveau graphique
        $pulseChart = new MesuresChart;

        //Axe X contenant les dates 
        $dates = $mesures->pluck('mesured_at');

        //Axe Y contenant les pulsations
        $pulses = $mesures->pluck('pulse');

        //Association des axes X Y pour le graphique
        $pulseChart->labels($dates);
        $pulseChart->dataset('Pulsations', 'line', $pulses)->backgroundColor('rgba(255, 99, 132, 0.2)');
        return $pulseChart;
    }

    public function blood_sugarChart($mesures)
    {
        //Création nouveau graphique
        $bsChart = new MesuresChart;

        //Axe X contenant les dates 
        $dates = $mesures->pluck('mesured_at');

        //Axe Y contenant les glyécmies
        $bs = $mesures->pluck('blood_sugar');

        //Association des axes X Y pour le graphique
        $bsChart->labels($dates);
        $bsChart->dataset('Glycémies', 'line', $bs)->backgroundColor('rgba(255, 99, 132, 0.2)');
        return $bsChart;
    }

    public function tensionChart($mesures)
    {
        //Création nouveau graphique
        $tensionChart = new MesuresChart;

        //Axe X contenant les dates 
        $dates = $mesures->pluck('mesured_at');

        //Axe Y contenant les températures
        $systoles = $mesures->pluck('systole');
        $diastoles = $mesures->pluck('diastoles');

        //Association des axes X Y pour le graphique
        $tensionChart->labels($dates);
        $tensionChart->dataset('Tension', 'line', $systoles, $diastoles)->backgroundColor('rgba(255, 99, 132, 0.2)');
        return $tensionChart;
    }
}
