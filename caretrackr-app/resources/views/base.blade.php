<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="{{asset('style.css')}}" rel="stylesheet">
    <title>@yield('title')</title> 

</head>

<body class="flex flex-col justify-between h-screen">
  <div class="wrapper">
      <nav class="bg-gray-800 p-6">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 mr-6">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo CareTrackR" class="h-8 w-auto">
                        <span class="text-gray-300 text-lg font-semibold">CareTrackR</span>
                    </div>
                    <div class="flex space-x-4">
                        <a href="{{route('register')}}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">S'inscrire</a>
                        <a href="{{route('login')}}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Se connecter</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex items-center">
            <div class="flex-shrink-0 mr-6">
                <span class="text-gray-300 text-lg font-semibold">
                    @auth
                        {{Auth::user()->name}}
                        <form class="nav-item" action="{{route('logout')}}" method="POST">
                            @method('delete')
                            @csrf
                            <button class="nav-link">Se déconnecter</button>
                    @endauth
                </span>
            </div>
      </nav>
  </div>
      <div class="text-center py-4">
        <h1 class="text-4xl font-semibold">@yield('page-title')</h1>
      </div>
    <div class="content container mx-auto px-4 py-8">
     @yield('content')
     @if (session('success'))
        <div class="alert alert-success text-gray-800 text-lg font-semibold">
            {{session('success')}}
        </div>
        @endif
        @if(session('message'))
        <div class="alert alert-success text-gray-800 text-lg font-semibold">
            {{session('message')}}
        </div>
        @endif
    </div>
</body>

<footer class="bg-gray-800 p-6">
  <div class="max-w-7xl mx-auto px-4">
      <p class="text-gray-300">
          <a href="mailto:camille.deglise@eduvaud.ch" class="hover:text-white">Camille Déglise</a> - CareTrackR-App - Avril 2024
      </p>
  </div>
</footer>
</html>