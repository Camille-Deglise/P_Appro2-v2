@extends('base')
@section('title', 'Home')
@section('page-title', 'Bienvenue')


@section('content')
        <div class="inline-flex max-w-screen ">
            <!-- Liste des patients -->
            <div class=" border border-solid border-gray-400 rounded-md mx-8 ">
                <h1 class="mx-4">Liste des patients suivis</h1>
                @foreach($patients as $patient)
                    <div class="overflow-auto mt-2 mx-6">
                        <strong>Nom:</strong> {{ $patient->name }} <br>
                        <strong>Prénom:</strong> {{ $patient->firstname }} <br>
                        <strong>Statut de santé:</strong> {{ $patient->health_status_label}}
                        <p>
                            <a href="{{ route('patient.show', ['patient' => $patient->id]) }}" class="underline decoration-gray-500">Voir le suivi complet</a>
                        </p> 
                        
                    </div>
                @endforeach
            </div>

            <!-- Liste des mesures médicales -->
            <div class="border border-solid border-gray-400 rounded-md mx-8 ">
                <h1 class="mx-4">Liste des 5 dernières mesures médicales</h1>
                @foreach($mesures as $mesure)
                    <div class="mt-2 mx-6">
                         
                        <strong>Patient:</strong> 
                            {{$mesure->patient_name}} {{ $mesure->patient_firstname }} <br>
                        <i>Date de mesure:</i> {{ $mesure->mesured_at }} <br>
                        
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
                        
                    </div>
                @endforeach
            </div>
        </div>
@endsection