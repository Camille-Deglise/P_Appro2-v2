<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewFormController extends Controller
{
    
    public function showNewForm()
    {
        return view('site.newForm');
    }
    
}
