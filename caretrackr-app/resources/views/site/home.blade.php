@extends('base')
@section('title', 'Home')
@section('page-title', 'Bienvenue')


@section('content')
    <div class="container">
        <div class="row">
            <!-- Liste des patients -->
            <div class="patient-list encard">
                <h1>Liste des patients suivis</h1>
                @foreach($patients as $patient)
                    <div class="patient-card">
                        <strong>Nom:</strong> {{ $patient->name }} <br>
                        <strong>Prénom:</strong> {{ $patient->firstname }} <br>
                        <strong>Statut de santé:</strong> {{ $patient->health_status_label}}
                        <p>
                            <a href="{{ route('patient.show', ['patient' => $patient->id]) }}">Voir le suivi complet</a>
                        </p> 
                        
                    </div>
                @endforeach
            </div>

            <!-- Liste des mesures médicales -->
            <div class="measurement-list encard">
                <h1>Liste des 5 dernières mesures médicales</h1>
                @foreach($mesures as $mesure)
                    <div class="mesure-card">
                         
                        <strong>Patient:</strong> 
                            {{$mesure->patient_name}} {{ $mesure->patient_firstname }} <br>
                        <strong>Type:</strong> <br>
                        @if($mesure->temperature)
                            Température: {{ $mesure->temperature }}°C <br>
                        @endif
                        @if($mesure->systole && $mesure->diastole)
                            Tension: {{ $mesure->systole }}/{{ $mesure->diastole }} mmHg <br>
                        @endif
                        @if($mesure->oxygen_saturation)
                            Saturation: {{ $mesure->oxygen_saturation }}% <br>
                        @endif
                        @if($mesure->pulse)
                            Pouls: {{ $mesure->pulse }} bpm <br>
                        @endif
                        @if($mesure->blood_sugar)
                            Glyécmie: {{ $mesure->blood_sugar }} mg/dL <br>
                        @endif
                        <strong>Date de mesure:</strong> {{ $mesure->mesured_at }}
                    </div>
                @endforeach
            </div>
              <!-- Encadré supplémentaire à droite -->
              <div class="graph-encard encard">
                <h1>Derniers graphiques</h1>
            </div>
        </div>
    </div>
@endsection