<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddMedicationController extends Controller
{
    public function showForm()
    {
        return view('site.addMedication');
    }
}
