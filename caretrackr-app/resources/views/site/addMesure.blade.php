<div class="border-2 rounded-lg p-4">
    <form class="max-w-md mx-auto" action="{{ route('addMesures', ['id'=> $patient->id]) }}" method="POST">
        @csrf
        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
        <h1 class="text-xl mb-4">Ajouter des mesures</h1>

        <div class="mb-4 flex flex-col md:flex-row">
            <div class="md:w-1/2 flex flex-col mb-4 md:mb-0">
                <label class="text-gray-500 font-bold " for="systole">Systole</label>
                <input class="bg-gray-200 appearance-none border border-gray-200 rounded py-2 px-4 mr-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    type="number" name="systole" id="systole" value="{{ old('systole') }}">
            </div>

            <div class="md:w-1/2 flex flex-col mb-4 md:mb-0">
                <label class="text-gray-500 font-bold " for="diastole">Diastole</label>
                <input class="bg-gray-200 appearance-none border border-gray-200 rounded py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    type="number" name="diastole" id="diastole" value="{{ old('diastole') }}">
            </div>
        </div>

        <div class="mb-4 flex flex-col md:flex-row">
            <div class="md:w-1/2 flex flex-col mb-4 md:mb-0">
                <label class="text-gray-500 font-bold " for="oxygen_saturation">Saturation</label>
                <input class="bg-gray-200 appearance-none border border-gray-200 rounded py-2 px-4 mr-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    type="number" name="oxygen_saturation" id="oxygen_saturation" value="{{ old('oxygen_saturation') }}">
            </div>

            <div class="md:w-1/2 flex flex-col mb-4 md:mb-0">
                <label class="text-gray-500 font-bold " for="temperature">Température C°</label>
                <input class="bg-gray-200 appearance-none border border-gray-200 rounded py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    type="number" step="0.1" name="temperature" id="temperature" value="{{ old('temperature') }}">
            </div>
        </div>

        <div class="mb-4 flex flex-col md:flex-row">
            <div class="md:w-1/2 flex flex-col mb-4 md:mb-0">
                <label class="text-gray-500 font-bold " for="pulse">Pouls</label>
                <input class="bg-gray-200 appearance-none border border-gray-200 rounded py-2 px-4 mr-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    type="number" name="pulse" id="pulse" value="{{ old('pulse') }}">
            </div>

            <div class="md:w-1/2 flex flex-col mb-4 md:mb-0">
                <label class="text-gray-500 font-bold " for="blood_sugar">Glycémie</label>
                <input class="bg-gray-200 appearance-none border border-gray-200 rounded py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    type="number" step="0.1" name="blood_sugar" id="blood_sugar" value="{{ old('blood_sugar') }}">
            </div>
        </div>

        <div class="mb-4 flex flex-col">
            <label class="text-gray-500 font-bold " for="mesured_at">Mesurée le :</label>
            <input class="bg-gray-200 appearance-none border border-gray-200 rounded py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                type="datetime-local" name="mesured_at" id="mesured_at" required value="{{ old('mesured_at') }}">
        </div>
        
        <button type="submit" class="shadow bg-gray-300 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-gray-800 font-bold py-2 px-4 mb-4 rounded mr-4">Ajouter</button>
    </form>
</div>

