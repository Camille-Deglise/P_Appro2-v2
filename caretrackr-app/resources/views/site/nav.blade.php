<div class="flex space-x-4 items-center">
    <div id="mes-suivis" class="relative">
        <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Mes suivis</a>
        <div class="absolute hidden bg-gray-500 rounded-md shadow-md">
            <ul>
                @foreach ($patients as $patient)
                    <li>
                        <a href="{{ route('patient.show', ['patient' => $patient->id]) }}" class="bg-gray text-black w-48 px-3 py-2 rounded-md text-sm font-medium flex items-center">{{$patient->name}} {{$patient->firstname}}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<div class="flex space-x-4"> <!-- Ajout d'une marge top -->
    <a href="{{ route('patient.create') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Ajouter patient</a>
    <a href="{{ route('import')}}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Importer des données</a>
    <a href="{{ route('setting.edit') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Mon profil</a>
</div>


