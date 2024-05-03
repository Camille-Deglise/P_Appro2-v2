<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="{{asset('style.css')}}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    <title>@yield('title')</title> 
</head>

<body class="flex flex-col justify-between min-h-screen">
    <div class="wrapper ">
        <nav class="bg-gray-800 p-6">
            <div class="max-w-7xl mx-auto px-4 flex justify-between items-center h-16">
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0 mr-6">
                        <a href="{{ Auth::check() ? route('home') : redirect()->intended('/') }}">
                            <img src="{{ asset('img/logo.png') }}" alt="Logo CareTrackR" class="h-8 w-auto">
                            <span class="text-gray-300 text-lg font-semibold">CareTrackR</span>
                        </a>
                    </div>
                    @auth
                        @php
                            $user = Auth::user();
                            $patients = $user ? $user->patients : [];
                        @endphp
                        <div class="flex space-x-4">
                            <!-- Widgets de la navigation si l'utilisateur est connecté -->
                            @include('site.nav')
                        </div>
                    @endauth
                </div>
                <div class="flex items-center ml-auto ">
                    <span class="text-gray-300 text-base font-semibold mr-4">
                        {{Auth::user()->fullName()}}
                    </span>
                    <form class="nav-item" action="{{route('logout')}}" method="POST">
                        @method('delete') 
                        @csrf
                        <button class="nav-link text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Se déconnecter</button>
                    </form>
                    @guest
                        <!-- Si l'utilisateur n'est pas connecté, afficher les liens S'inscrire et Se connecter -->
                        <div class="flex space-x-4">
                            <a href="{{ route('register') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">S'inscrire</a>
                            <a href="{{ route('login') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Se connecter</a>
                        </div>
                    @endguest
                </div>
            </div>
        </nav>
         <!-- Fin de la nav-->
        <div class="text-center py-4">
            <h1 class="text-4xl font-semibold">@yield('page-title')</h1>
        </div>
        <div class="content container mx-auto px-2 py-2">
            @if (session('success'))
                <div class="alert alert-success text-green-800 text-lg font-semibold">
                    {{session('success')}}
                </div>
            @endif
            @if(session('message'))
                <div class="alert alert-success text-gray-800 text-lg font-semibold">
                    {{session('message')}}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger text-red-800 text-lg font-semibold">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>  
            @endif
             <!-- Fin titre et alertes-->
            @yield('content')
        </div>
    </div>
     <!-- Fin content-->
    <footer class="bg-gray-800 p-6 ">
        <div class="max-w-7xl mx-auto px-4">
            <p class="text-gray-300 text-center">
                <a href="mailto:camille.deglise@eduvaud.ch" class="hover:text-white">Camille Déglise</a> - CareTrackR-App - Avril 2024
            </p>
        </div>
    </footer> 
</body>
</html>
