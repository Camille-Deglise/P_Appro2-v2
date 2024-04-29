
<form class="w-full max-w-sm mx-auto" action="{{route('addMesures', ['id'=> $patient->id])}}" method="POST">
    @csrf
    <input type="hidden" name="patient_id" value="{{ $patient->id }}">
    <h1>Ajouter des mesures</h1>

    <div class="mb-6 flex items-center">
        <label class="block text-gray-500 font-bold mr-4" for="systole" style="min-width: 100px;">
            Systole
        </label>
        <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-grey-500"
        type="number" name="systole" id="systole" value="{{ old('systole') }}">

        <label class="block text-gray-500 font-bold mr-4" for="diastole" style="min-width: 100px;">
            Diastole
        </label>
        <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-grey-500"
        type="number" name="diastole" id="diastole" value="{{ old('diastole') }}">
    </div>

    <div class="mb-6 flex items-center">
        <label class="block text-gray-500 font-bold mr-4" for="oxygen_saturation" style="min-width: 100px;">
            Saturation
        </label>
        <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-grey-500"
        type="number" name="oxygen_saturation" id="oxygen_saturation" value="{{ old('oxygen_saturation') }}">

        <label class="block text-gray-500 font-bold mr-4" for="temperature" style="min-width: 100px;">
            Température C°
        </label>
        <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-grey-500"
        type="number" step="0.1" name="temperature" id="temperature" value="{{ old('temperature') }}">
    </div>

    <div class="mb-6 flex items-center">
        <label class="block text-gray-500 font-bold mr-4" for="pulse" style="min-width: 100px;">
            Pouls
        </label>
        <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-grey-500"
        type="number" name="pulse" id="pulse" value="{{ old('pulse') }}">

        <label class="block text-gray-500 font-bold mr-4" for="blood_sugar" style="min-width: 100px;">
            Glycémie
        </label>
        <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-grey-500"
        type="number" step="0.1" name="blood_sugar" id="blood_sugar" value="{{ old('blood_sugar') }}">
    </div>

    <div class="mb-6 flex items-center">
        <label class="block text-gray-500 font-bold mr-4" for="mesured_at" style="min-width: 100px;">
            Mesurée le : 
        </label>
        <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-grey-500"
        type="datetime-local" name="mesured_at" id="mesured_at" required value="{{ old('mesured_at') }}">
    </div>

        <button type="submit" class="shadow bg-gray-300 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-gray-800 font-bold py-2 px-4 rounded mr-4">Ajouter</button>
</form>
