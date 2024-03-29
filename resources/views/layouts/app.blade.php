<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="white">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'UniArctic') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        {{-- <script src="{{ secure_asset('build/assets/app-DgbtYFve.js') }}"></script> --}}

        <script>
            window.addEventListener('scroll', function() {
  var nav = document.querySelector('nav');
  nav.classList.toggle('fixed', window.scrollY > 90);
  nav.classList.toggle('right-0', window.scrollY > 90);
  nav.classList.toggle('z-50', window.scrollY > 90);
});

        </script>
        <!-- Styles -->
        {{-- <link href="{{ secure_asset('build/assets/app-BE0mZvCE.css') }}" rel="stylesheet"> --}}
        @livewireStyles
        @bukStyles
    </head>
    <body class="font-sans antialiased ">
        <x-banner />
        <div class="min-h-screen bg-gray-100 dark:bg-slate-800">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow dark:bg-slate-800 dark:shadow-slate-900 ">
                    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif
            
            <!-- Page Content -->
            <main >
                {{ $slot }}
            </main>
           
        </div>
        @include('footer')
        @stack('modals')

        @livewireScripts
    </body>
</html>
