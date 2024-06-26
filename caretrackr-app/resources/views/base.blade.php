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
        <!--Navigation -->
        <nav class="bg-gray-800 p-6">
           @include('site.navbar')
        </nav>

        <!--Contenu -->
        <div class="text-center py-4">
            <h1 class="text-4xl font-semibold mb-6">@yield('page-title')</h1>
        </div>
        
        <div class="content container mx-auto px-2 py-2">
            @include('site.errors-user')
    
            @yield('content')
        </div>
    </div>
    <!--Footer-->
    <footer class="bg-gray-800 p-6 ">
        <div class="max-w-7xl mx-auto px-4">
            <p class="text-gray-300 text-center">
                <a href="mailto:camille.deglise@eduvaud.ch" class="hover:text-white">Camille Déglise</a> - CareTrackR-App - Avril 2024 - v.1.2 Mai 2024
            </p>
        </div>
    </footer> 
</body>
</html>
