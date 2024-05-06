<div class="max-w-7xl mx-auto px-4 flex justify-between items-center h-16">
    <div class="flex items-center space-x-4">
        <div class="flex-shrink-0 mr-6">
            <a href="{{ Auth::check() ? route('home') : redirect()->intended('/') }}">
                <img src="{{ asset('img/logo.png') }}" alt="Logo CareTrackR" class="h-8 w-auto">
                <span class="text-gray-300 text-lg font-semibold">CareTrackR</span>
            </a>
        </div>
        @guest
            <div class="flex space-x-4">
                <a href="{{ route('register') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">S'inscrire</a>
                <a href="{{ route('login') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Se connecter</a>
            </div>
        @endguest
    </div>
    @include('site.nav-auth')
</div>
