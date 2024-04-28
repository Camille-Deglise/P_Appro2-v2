@extends('base')
@section('title', 'Importer des données')
@section('page-title', 'Importer des données')
@section('content')
<form action="{{ route('import.process') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="csv_file">Sélectionner un fichier CSV :</label>
        <input type="file" name="csv_file" id="csv_file" class="form-control-file">
    </div>
    <button class="shadow bg-gray-300 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-gray-800 font-bold py-2 px-4 rounded" type="submit">
        Importer</button>
</form>

@endsection