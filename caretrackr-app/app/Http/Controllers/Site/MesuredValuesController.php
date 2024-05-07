<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Util\NoChartData;
use App\Http\Requests\MesuredValuesRequest;
use App\Models\MesuredValue;
use App\Models\Patient;
use App\Charts\MesuresChart;


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
        $mesuresFiltred = $mesures->filter(function ($mesures)
        {
            return $mesures -> temperature != null;
        });
        
        // Vérifier s'il y a au moins trois valeurs de température
        if ($mesuresFiltred->pluck('temperature')->count() < 3) {
        return new NoChartData("Minimum 3 valeurs sont nécessaires pour générer le graphique des températures");
        }

        //Création nouveau graphique
        $tempChart = new MesuresChart;

        //Axe X contenant les dates 
        $dates = $mesuresFiltred->pluck('mesured_at');
       
        //Axe Y contenant les températures
        $temperatures = $mesuresFiltred->pluck('temperature');

        //Association des axes X Y pour le graphique
        $tempChart->labels($dates);
        $tempChart->dataset('Températures', 'line', $temperatures)->backgroundColor('rgba(255, 99, 132, 0.2)');
        return $tempChart;
    }
    
    public function saturationChart($mesures)
    {
        $mesuresFiltred = $mesures->filter(function ($mesures)
        {
            return $mesures -> saturation != null;
        });

        // Vérifier s'il y a au moins trois valeurs de température
        if ($mesuresFiltred->pluck('oxygen_saturation')->count() < 3) {
            
            return new NoChartData("Minimum 3 valeurs sont nécessaires pour générer le graphique de la saturation");
        }
        //Création nouveau graphique
        $satChart = new MesuresChart;

        //Axe X contenant les dates 
        $dates = $mesuresFiltred->pluck('mesured_at');

        //Axe Y contenant les températures
        $saturation = $mesuresFiltred->pluck('oxygen_saturation');

        //Association des axes X Y pour le graphique
        $satChart->labels($dates);
        $satChart->dataset('Saturation O2', 'line', $saturation)->backgroundColor('rgba(255, 99, 132, 0.2)');
        return $satChart;
    }

    public function pulseChart($mesures)
    {
        $mesuresFiltred = $mesures->filter(function ($mesures)
        {
            return $mesures -> pulse != null;
        });
        // Vérifier s'il y a au moins trois valeurs de température
        if ($mesuresFiltred->pluck('pulse')->count() < 3) {
            return new NoChartData("Minimum 3 valeurs sont nécessaires pour générer le graphique des pulsations");
            }
        //Création nouveau graphique
        $pulseChart = new MesuresChart;

        //Axe X contenant les dates 
        $dates = $mesuresFiltred->pluck('mesured_at');

        //Axe Y contenant les pulsations
        $pulses = $mesuresFiltred->pluck('pulse');

        //Association des axes X Y pour le graphique
        $pulseChart->labels($dates);
        $pulseChart->dataset('Pulsations', 'line', $pulses)->backgroundColor('rgba(255, 99, 132, 0.2)');
        return $pulseChart;
    }

    public function blood_sugarChart($mesures)
    {
        $mesuresFiltred = $mesures->filter(function ($mesures)
        {
            return $mesures -> blood_sugar != null;
        });
        // Vérifier s'il y a au moins trois valeurs de température
        if ($mesuresFiltred->pluck('blood_sugar')->count() < 3) {
            return new NoChartData("Minimum 3 valeurs sont nécessaires pour générer le graphique des glycémies");
            }
        //Création nouveau graphique
        $bsChart = new MesuresChart;

        //Axe X contenant les dates 
        $dates = $mesuresFiltred->pluck('mesured_at');

        //Axe Y contenant les glyécmies
        $bs = $mesuresFiltred->pluck('blood_sugar');

        //Association des axes X Y pour le graphique
        $bsChart->labels($dates);
        $bsChart->dataset('Glycémies', 'line', $bs)->backgroundColor('rgba(255, 99, 132, 0.2)');
        return $bsChart;
    }

    public function tensionChart($mesures)
    {
        $mesuresFiltred = $mesures->filter(function ($mesures)
        {
            return $mesures -> systole != null && $mesures -> diastole != null;
        });
        // Vérifier s'il y a au moins trois valeurs de température
        if (($mesuresFiltred->pluck('systole')->count() < 3) && ($mesures->pluck('diastole')->count()<3)){
            return new NoChartData("Minimum 3 valeurs sont nécessaires pour générer le graphique de la tension");
            }
        //Création nouveau graphique
        $tensionChart = new MesuresChart;

        //Axe X contenant les dates 
        $dates = $mesuresFiltred->pluck('mesured_at');

        //Axe Y contenant les températures
        $systoles = $mesuresFiltred->pluck('systole');
        $diastoles = $mesuresFiltred->pluck('diastole');

        //Association des axes X Y pour le graphique
        $tensionChart->labels($dates);
        $tensionChart->dataset('Systole', 'line', $systoles)->backgroundColor('rgba(255, 99, 132, 0.2)');
        $tensionChart->dataset('Diastole', 'line', $diastoles)->backgroundColor('rgba(54, 162, 235, 0.2)');

        return $tensionChart;
    }
}
