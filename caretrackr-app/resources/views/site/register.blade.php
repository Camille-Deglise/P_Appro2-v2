@extends('base')
@section('title', 'S\'inscrire')

@section('page-title', 'Inscription')
    
@section('content')
<form class="w-full max-w-sm mx-auto" action="{{route('register')}}" method="POST">
    @csrf
    <div class="mb-6 flex items-center">
      <label class="block text-gray-500 font-bold mr-4" for="name" style="min-width: 100px;">
        Nom 
      </label>
      <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-grey-500" 
        id="name" name="name" type="text" value="Entrer un nom ">
    </div>
    <div class="mb-6 flex items-center">
      <label class="block text-gray-500 font-bold mr-4" for="firstname" style="min-width: 100px;">
        Prénom
      </label>
      <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-grey-500" 
        id="firstname" name="firstname" type="text" value="Entrer un prénom">
    </div>
    <div class="mb-6 flex items-center">
      <label class="block text-gray-500 font-bold mr-4" for="email" style="min-width: 100px;">
        Email
      </label>
      <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-grey-500" 
        id="email" name="email" type="email" value="Entrer un email valide">
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
  </div>

    <div class="mb-6 flex items-center">
      <label class="block text-gray-500 font-bold mr-4" for="password" style="min-width: 100px;">
        Mot de passe
      </label>
      <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-grey-500" 
        id="password" name="password" type="password" value="****">
    </div>
    <div class="md:flex md:items-center">
      <div class="md:w-1/3"></div>
      <div class="md:w-2/3">
        <button class="shadow bg-gray-300 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-gray-800 font-bold py-2 px-4 rounded" type="submit">
          S'inscrire
        </button>
      </div>
    </div>
  </form>
  @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@endsection