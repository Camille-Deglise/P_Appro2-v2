@extends('base')
@section('title', 'Suivis de patients')
@section('page-title', 'Suivi de ' . $patient->name . ' ' . $patient->firstname)

@section('content')

<div class="inline-flex space-x-8 mb-10">
    <div class="border-2 rounded-md px-6">
            <h2>Résumé administratif</h2>
            <p>Nom: {{$patient->name}}</p>
            <p>Prénom: {{$patient->firstname}}</p>
            <p>Date de naissance : {{$patient->birth_date}} </p>
            <p>Service : 
                @foreach ($patient->services as $service)
                    {{ $service->name }},
                @endforeach
            </p>
            <p>Date d'entrée : {{$serviceInfo->pivot->date_entry}}</p>
            <p>Motif de prise en charge : {{$serviceInfo->pivot->reason_hospitalization}} </p>
            <p>Allergies : 
                @foreach ($patient->allergies as $allergy)
                    <br> {{ $allergy->label }} 
                @endforeach
            </p>
            <p>Antécédents : 
                @foreach ($patient->medical_histories as $medical_history)
                    {{ $medical_history->label }},
                @endforeach
            </p>
            <p>Médications : 
                @foreach ($patient->medications as $medication)
                    {{ $medication->label }},
                @endforeach
            </p>
        
        <div class="flex mt-10 mb-3 ">
            <form action="{{ route('patient.edit', ['patient' => $patient->id]) }}" method="GET">
                <button type="submit" class="shadow bg-gray-300 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-gray-800 font-bold py-2 px-4 rounded mr-4">Modifier profil</button>
            </form>
            <form action="{{ route('disable', ['patient' => $patient->id]) }}" method="GET">
                <button type="submit" class="shadow bg-red-300 hover:bg-red-400 focus:shadow-outline focus:outline-none text-gray-800 font-bold py-2 px-4 rounded">Désactiver patient</button>
            </form>
        </div>
    </div>
    <div class="border-2 rounded-md overflow-auto h-96 mb-3 px-4">
                    <h2>Mesures prises</h2>
                    @foreach($mesures as $mesure)
                        <div class="mesure-card">
                            <i>Date de mesure:</i> {{ $mesure->mesured_at }}
                            <p>Type</p>
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
    <div class="add_mesures">
        @include('site.addMesure')
    </div>
</div>
<div class="charts">
        @include('site.charts')
</div>

@endsection
