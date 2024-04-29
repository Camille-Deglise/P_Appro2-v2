@extends('base')
@section('title', 'Suivis de patients')
@section('page-title', 'Suivis de patients')
@section('content')

<div class="wrapper">
    <div class="content">
        <div class="row">
            <div class="patient-show">
                    <h2>Résumé administratif de {{$patient->name}} {{$patient->firstname}}</h2>
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
                            {{ $allergy->label }},
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
                <div class="button-container flex">
                    <form action="{{ route('patient.edit', ['patient' => $patient->id]) }}" method="GET">
                        <button type="submit" class="shadow bg-gray-300 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-gray-800 font-bold py-2 px-4 rounded mr-4">Modifier profil</button>
                    </form>
                    <form action="{{ route('disable', ['patient' => $patient->id]) }}" method="GET">
                        <button type="submit" class="shadow bg-red-300 hover:bg-red-400 focus:shadow-outline focus:outline-none text-gray-800 font-bold py-2 px-4 rounded">Désactiver patient</button>
                    </form>
                </div>
            </div>

            <div class="add_mesures">
                @include('site.addMesure')
            </div>
        </div>
    </div>
</div>


@endsection
