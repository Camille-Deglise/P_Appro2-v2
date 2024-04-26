@section('title', $patient->exists ? "Modifier les données patients" : "Ajouter un nouveau patient")
<form class="w-full max-w-sm mx-auto" action="{{route ($patient->exists ? 'patient.update': 'patient.store', 
['patient' => $patient])}}" method="POST">
    @csrf
    @method($patient->exists ? 'put' : 'post')
    <div class="mb-6 flex items-center">
        <label class="block text-gray-500 font-bold mr-4" for="name" style="min-width: 100px;">
            Nom
        </label>
        <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-grey-500"
               id="name" name="name" type="text" placeholder="Entrer un nom" required>
        @error('name')
            {{$message}}
        @enderror
    </div>

    <div class="mb-6 flex items-center">
        <label class="block text-gray-500 font-bold mr-4" for="firstname" style="min-width: 100px;">
            Prénom
        </label>
        <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-grey-500"
               id="firstname" name="firstname" type="text" placeholder="Entrer un prénom" required>
        @error('firstname')
            {{$message}}
        @enderror
    </div>
    <div class="mb-6 flex items-center">
        <label class="block text-gray-500 font-bold mr-4" for="birth_date" style="min-width: 100px;">
            Prénom
        </label>
        <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-grey-500"
               id="birth_date" name="birth_date" type="date" min="1900-01-01" max="<?php echo date('Y-m-d'); ?>" required>
        @error('birth_date')
            {{$message}}
        @enderror
    </div>
    <div class="mb-6 flex items-center">
        <label class="block text-gray-500 font-bold mr-4" style="min-width: 100px;" >
            Genre
        </label>
        <div class="mr-4">
            <input type="radio" id="man" name="gender" value="1">
            <label for="man">Homme</label>
        </div>
        <div class="mr-4">
            <input type="radio" id="woman" name="gender" value="2">
            <label for="woman">Femme</label>
        </div>
        <div class="mr-4">
            <input type="radio" id="nonBinary" name="gender" value="3">
            <label for="nonBinary">Non-binaire</label>
        </div>
    </div>

    <div class="mb-6 flex items-center">
        <label class="block text-gray-500 font-bold mr-4" for="reason_hospitalization" style="min-width: 100px;">
            Raison de l'hospitalisation
        </label>
        <textarea class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-grey-500"
                  id="reason_hospitalization" name="reason_hospitalization" required></textarea>
    </div>

    <div class="mb-6 flex items-center">
        <label class="block text-gray-500 font-bold mr-4" for="service" style="min-width: 100px;">
            Service
        </label>
        <select name="service" id="service" class="form-control" required>
            <option value="">Sélectionnez un service</option>
            @foreach($services as $service)
                <option value="{{ $service->id }}">{{ $service->name }}</option>
            @endforeach
        </select>
        @error('service')
            {{$message}}
        @enderror
    </div>

    <div class="mb-6 flex items-center">
        <label class="block text-gray-500 font-bold mr-4" for="health_status_id" style="min-width: 100px;">
            État de santé
        </label>
        <select name="health_status_id" id="health_status_id" class="form-control" required>
            <option value="">Sélectionnez un état de santé</option>
            @foreach($health_statuses_id as $health_status_id)
                <option value="{{ $health_status_id->id }}">{{ $health_status_id->label }}</option>
            @endforeach
        </select>
        @error('health_status_id')
            {{$message}}
        @enderror
    </div>

    <div class="mb-6">
        <label class="block text-gray-500 font-bold mb-2" for="medication" style="min-width: 100px;">
            Traitement médicamenteux
        </label>   
            <select name="medication[]" id="medication" class="form-control" multiple >
                <option value="">Sélectionnez un ou plusieurs médicaments</option>
                @foreach($medications as $medication)
                    <option value="{{ $medication->id }}">{{ $medication->label }}</option>
                @endforeach
            </select>
    </div>

    <div class="mb-6">
        <label class="block text-gray-500 font-bold mb-2" for="allergies" style="min-width: 100px;">
            Allergies
        </label>
            <select name="allergy[]" id="allergy" class="form-control" multiple>
                <option value="">Sélectionnez une ou plusieurs allergies</option>
                @foreach($allergies as $allergy)
                    <option value="{{ $allergy->id }}">{{ $allergy->label }}</option>
                @endforeach
            </select>
    </div>

        <div class="mb-6">
            <label class="block text-gray-500 font-bold mb-2" for="medical_histories" style="min-width: 100px;">
                Antécédents
            </label>
                <select name="medical_history[]" id="medical_history" class="form-control" multiple >
                    <option value="">Sélectionnez un ou plusieurs antécédents</option>
                        @foreach($medical_histories as $medical_history)
                            <option value="{{ $medical_history->id }}">{{ $medical_history->label }}</option>
                        @endforeach
                </select>
        </div>
    <div class="mb-6 flex items-center">
        <label class="block text-gray-500 font-bold mr-4" for="insurance" style="min-width: 100px;">
            Assurance
        </label>
        <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-grey-500"
               id="insurance" name="insurance" type="text" placeholder="Entrer une assurance" required>
    </div>

    <div class="mb-6 flex items-center">
        <label class="block text-gray-500 font-bold mr-4" for="avs_number" style="min-width: 100px;">
            Numéro AVS
        </label>
        <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-grey-500"
               id="avs_number" name="avs_number" type="text" placeholder="756.xxxx.xxxx.xx" required>
    </div>

    <div class="mb-6 flex items-center">
        <label class="block text-gray-500 font-bold mr-4" for="road_number" style="min-width: 100px;">
            N°Rue
        </label>
        <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-grey-500"
               id="road_number" name="road_number" type="text" placeholder="Entrer un numéro de rue" required>
    </div>

    <div class="mb-6 flex items-center">
        <label class="block text-gray-500 font-bold mr-4" for="road" style="min-width: 100px;">
            Rue
        </label>
        <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-grey-500"
               id="road" name="road" type="text" placeholder="Entrer une rue" required>
    </div>

    <div class="mb-6 flex items-center">
        <label class="block text-gray-500 font-bold mr-4" for="npa" style="min-width: 100px;">
            NPA
        </label>
        <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-grey-500"
               id="npa" name="npa" type="text" placeholder="Entrer un NPA" required>
    </div>

    <div class="mb-6 flex items-center">
        <label class="block text-gray-500 font-bold mr-4" for="city" style="min-width: 100px;">
            Ville
        </label>
        <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-grey-500"
               id="city" name="city" type="text" placeholder="Entrer une ville" required>
    </div>
    <div class="mb-6 flex items-center">
        <label class="block text-gray-500 font-bold mr-4" for="city" style="min-width: 100px;">
            Pays
        </label>
        <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-grey-500"
               id="country" name="country" type="text" placeholder="Entrer un pays" required>
    </div>
    
    <div class="md:flex md:items-center">
        <div class="md:w-1/3"></div>
        <div class="md:w-2/3">
            <button class="shadow bg-gray-300 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-gray-800 font-bold py-2 px-4 rounded" type="submit">
                @if ($patient->exists)
                    Modifier
                @else
                    Ajouter
                @endif
            </button>
        </div>
    </div>
</form>
