@extends('base')
@section('title', 'Désactiver patient')
@section('page-title', 'Désactiver un patient')
@section('content')
<h1>Désactiver {{$patient->name}} {{$patient->firstname}}</h1>
<p>Pour désactiver ce patient, veuillez remplir les champs ci-dessous</p>
<form action="{{ route('deactivated', ['patient' => $patient->id]) }}" method="POST">
@csrf
    <div class="mb-4">
        <label for="discharge_date"  class="block text-gray-700 font-bold">Date de sortie</label>
        <input type="date" name="discharge_date" id="discharge_date" class="form-input mt-1 block w-full" required >
    </div>
    <div class="mb-4">
        <label for="health_status_id" class="block text-gray-700 font-bold">Raison de sortie :</label>
        <select name="health_status_id" id="health_status_id" class="form-select mt-1 block w-full" required>
            <option value="" disabled selected>Choisir un statut de sortie</option>
            @foreach ($health_statuses as $health_status)
                <option value="{{ $health_status->id }}">{{ $health_status->label }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-4">
        <button type="submit" class="shadow bg-red-300 hover:bg-red-400 focus:shadow-outline focus:outline-none text-gray-800 font-bold py-2 px-4 rounded">
            Désactiver</button>
    </div>
</form>




@endsection