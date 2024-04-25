@extends('base')
@section('title', 'Suivis de patients')
@section('page-title', 'Suivis de patients')
@section('content')

<h1>Suivi de {{$patient->name}}</h1>

<div class="patient-card">
    Résumé administratif patient
    Nom:{{$patient->name}}
    Prénom:{{$patient->firstname}}
    Date de naissance : {{$patient->birth_date}}
    Motif de prise en charge : {{$patient}}
    Service : {{$patient->services}}
    Allergies : {{$patient->allergies}}
    Antécédents : {{$patient->medical_histories}}
    Médications : {{$patient->medications}}
    <button class="shadow bg-gray-300 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-gray-800 font-bold py-2 px-4 rounded" type="submit">
    Modifier profil</button>
</div>

@endsection
