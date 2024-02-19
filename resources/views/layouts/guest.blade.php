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
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
        <script src="{{ secure_asset('build/assets/app-DgbtYFve.js') }}"></script>

        <!-- Styles -->
        <link href="{{ secure_asset('build/assets/app-BE0mZvCE.css') }}" rel="stylesheet">
        @livewireStyles
    </head>
    <body>
      
        <div class="font-sans text-gray-900 antialiased"> 
            {{ $slot }}
        </div>
        <div class="absoulute hidden">
            <label for="darkswitch" class="flex items-center cursor-pointer sm:fixed sm:top-10 sm:right-0 p-4">
                <div class="relative">
                  <input id="darkswitch" type="checkbox" class="sr-only" />
                  <div class="block bg-yellow-500 w-14 h-8  rounded-full"></div>
                  <div class="dot absolute left-1 top-1 bg-white w-6 h-6 rounded-full transition flex items-center justify-center">
                    <svg id="sunIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5 text-yellow-500">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2v1m0 18v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <svg id="moonIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 hidden">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                    </svg>
                  </div>
              </label>
        </div>

        @livewireScripts
    </body>
</html>
