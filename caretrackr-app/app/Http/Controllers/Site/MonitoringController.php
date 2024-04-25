<?php

namespace App\Http\Controllers\Site;
use App\Models\Patient;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    public function showMonitoring(Patient $patient)
    {  
        //dd($patient);
        
        return view(('site.monitoring'), ['patient' => $patient]);

    }

    
}
