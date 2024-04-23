@extends('base')
@section('title', 'Home')
@section('page-title', 'Bienvenue')

@section('content')
    <div class="container">
        <h1>Liste des 5 derniers patients</h1>

        <div class="row">
            @foreach($patients as $patient)
                <div class="col-md-4"> 
                    <div class="patient-card">
                        <strong>Nom:</strong> {{ $patient->name }} <br>
                        <strong>Prénom:</strong> {{ $patient->firstname }} <br>
                        <strong>Statut de santé:</strong> {{ $patient->health_status_label }}
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection