@extends('base')
@section('title', 'Mon profil')
@section('page-title', 'Modifier mon profil')
@section('content')

<form class="w-full max-w-sm mx-auto" action="{{route('setting.update', $user->id)}}" method="POST">
    @csrf
    @method('PUT')
    <input type="hidden" name="user_id" value="{{ $user->id }}">
    <div class="mb-6 flex items-center">
      <label class="block text-gray-500 font-bold mr-4" for="name" style="min-width: 100px;">
        Nom 
      </label>
      <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-grey-500" 
        id="name" name="name" type="text" value="{{old('name', $user->name)}}" required>
        @error('name')
          {{$message}}
        @enderror
    </div>
    <div class="mb-6 flex items-center">
      <label class="block text-gray-500 font-bold mr-4" for="firstname" style="min-width: 100px;">
        Prénom
      </label>
      <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-grey-500" 
        id="firstname" name="firstname" type="text" value="{{old('firstname', $user->firstname)}}" required>
        @error('firstname')
          {{$message}}
        @enderror
    </div>
    <div class="mb-6 flex items-center">
      <label class="block text-gray-500 font-bold mr-4" for="email" style="min-width: 100px;">
        Email
      </label>
      <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-grey-500" 
        id="email" name="email" type="email" value="{{old('email', $user->email)}}" required>
        @error('email')
          {{$message}}
        @enderror
    </div>
    <div class="mb-6 flex items-center">
      <label class="block text-gray-500 font-bold mr-4" for="service" style="min-width: 100px;">
          Service
      </label>
      <select name="service" id="service" class="form-control" required>
        <option value=""disabled selected>Sélectionnez un service</option>
        @foreach($services as $service)
        <option value="{{ $service->id }}" {{ old('service', $user->service_id) == $service->id ? 'selected' : '' }}>
          {{$service->name}}
        </option>
        @endforeach
    </select>
    @error('serivce')
          {{$message}}
        @enderror
  </div>

    <div class="md:flex md:items-center">
      <div class="md:w-1/3"></div>
      <div class="md:w-2/3">
        <button class="shadow bg-gray-300 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-gray-800 font-bold py-2 px-4 rounded" type="submit">
          Modifier
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
