<div id="mes-suivis" class="relative align-middle">
    <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Mes suivis</a>
    <div class ="absolute hidden bg-whit shadow-md">
        <ul>
        @foreach ($patients as $patient )
        <a href="{{ route('patient.show', ['patient' => $patient->id]) }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">{{$patient->name}} {{$patient->firstname}}</a>
        @endforeach
        </ul>
    </div>
</div>
<a href="{{ route('patient.create') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Ajouter patient</a>
<a href="{{ route('import')}}"class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Importer des données</a>
<a href="{{ route('setting.edit') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Mon profil</a>