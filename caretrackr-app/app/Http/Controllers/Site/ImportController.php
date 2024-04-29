<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Service;
use App\Models\User;
use App\Models\MesuredValue;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function showForm()
    {
        return view('site.import');
    }


    public function process(Request $request)
    {
        $file = $request->file('csv_file');

        // Validez que le fichier a été téléchargé et est un fichier CSV
        if ($file && $file->getClientOriginalExtension() == 'csv') {
            // Lisez le contenu du fichier CSV
            $contents = file_get_contents($file->getRealPath());

            // Traitement des données CSV et insertion dans la base de données
            $rows = explode("\n", $contents);
        

            // Ignorer la première ligne (en-têtes de colonnes)
            $dataRows = array_slice($rows, 1);

            //Ignorer les lignes vides
            $nonEmptyRows = array_filter($dataRows, 'strlen');
            if(!empty($nonEmptyRows))
            {
                foreach ($nonEmptyRows as $row) 
                {
                    $data = str_getcsv($row);
                   
                    // Validez et transformez les données si nécessaire
                    $patientData = [
                        'name' => $data[0],
                        'firstname' => $data[1],
                        'birth_date' => $data[2],
                        'gender' => $data[3],
                        'insurance' => $data[4],
                        'road' => $data[5],
                        'road_number' => $data[6],
                        'npa' => $data[7],
                        'avs_number' => $data[8],
                        'city' => $data[9],
                        'country' => $data[10],
                        'health_status_id' => $data[11],
                        'user_id' => $data[12],
                    ];

                    $measuredValuesData = [
                        'temperature' => $data[15],
                        'systole' => $data[16],
                        'diastole' => $data[17],
                        'oxygen_saturation' => $data[18],
                        'pulse' => $data[19],
                        'bloog_sugar' => $data[20],
                        'mesured_at' => $data[21],
                    ];

                    
                    /// Récupérer le service associé à l'utilisateur
                    $user = User::findOrFail($data[12]);
                    $service = $user->services;

                    // Insérez les données dans la base de données
                    $patient = Patient::create($patientData);
                    $measuredValues = MesuredValue::create($measuredValuesData);

                    // Assurez-vous de gérer correctement les relations entre les modèles et la table pivot
                    $patient->services()->attach($service->id, [
                        'reason_hospitalization' => $data[13],
                        'date_entry' => $data[14],
                    ]);
                    $patient->mesured_values()->save($measuredValues);
                }
                return redirect()->route('home')->with('success', 'Importation réussie.');
            } else{
                return redirect()->back()->with('error', 'Le fichier CSV est vide.');
            }
               
        }

        return redirect()->back()->with('error', 'Veuillez sélectionner un fichier CSV.');
    }
}

