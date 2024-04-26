@extends('base')
@section('title', 'Suivis de patients')
@section('page-title', 'Suivis de patients')
@section('content')

<h1>Suivi de {{$patient->name}} {{$patient->firstname}}</h1>

<div class="patient-card">
    <p>Résumé administratif patient</p>
    <p>Nom: {{$patient->name}}</p>
    <p>Prénom: {{$patient->firstname}}</p>
    <p>Date d'entrée : {{}} </p>
    <p>Motif de prise en charge : {{}} </p>
    <p>Service : 
        @foreach ($patient->services as $service)
            {{ $service->name }},
        @endforeach
    </p>
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
    <button class="shadow bg-gray-300 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-gray-800 font-bold py-2 px-4 rounded" type="submit">Modifier profil</button>
</div>

@endsection
