<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="white">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>UniArctic</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        {{-- <script src="{{ secure_asset('build/assets/app-DgbtYFve.js') }}"></script> --}}

        <!-- Styles -->
        {{-- <link href="{{ secure_asset('build/assets/app-BE0mZvCE.css') }}" rel="stylesheet"> --}}
        @livewireStyles
        <style>
            .bg-dots-darker{background-image:url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E")}
            .dark\:bg-dots-lighter{background-image:url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E")}
        
        
        </style>
    </head>
    <body class="antialiased newer">
       
        {{-- <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 selection:bg-red-500 selection:text-white" style="background-image: url('{{ asset('storage/background/uniback.jpg') }}')"> --}}
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-center bg-gray-200 dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            <section>
                <label for="darkswitch" class="flex items-center cursor-pointer sm:fixed sm:top-10 sm:right-0 p-4">
                    <div class="relative">
                      <input id="darkswitch" type="checkbox" class="sr-only" />
                      <div class="block bg-yellow-300 w-14 h-8  rounded-full"></div>
                      <div class="dot absolute left-1 top-1 bg-white w-6 h-6 rounded-full transition flex items-center justify-center">
                        <svg id="sunIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5 text-yellow-300">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2v1m0 18v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <svg id="moonIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 hidden">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                        </svg>
                      </div>
                  </label>
                @if (Route::has('login'))
                    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                        @auth
                            <a href="{{ url('/home') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-slate-300 dark:hover:dark:text-slate-100 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
                        @else
                            <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-slate-300 dark:hover:dark:text-slate-100 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>
    
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-slate-300 dark:hover:dark:text-slate-100 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </section>
            <section class="mt-16 flex justify-center px-4 md:mt-12 xl:mt-0">
                <div class="relative w-full mt-8 max-w-screen-xl xl:p-8 xl:py-16">
                    <div class="z-50">
                        <img src="{{ asset('storage/background/uniback.jpg') }}" alt="Home Image">
                    </div>
                    <div class="absolute z-10 right-2 bottom-2 flex justify-center w-full gap-x-12">
                        <a href="{{ route('article.search') }}" class="w-24 h-24 flex items-center justify-center bg-red-500 border-solid border-2 border-red-600">
                            1
                        </a>
                         <div class="w-24 h-24 flex items-center justify-center bg-red-500 border-solid border-2 border-red-600">
                            1
                         </div>
                         <div class="w-24 h-24 flex items-center justify-center bg-gray-900 border-solid border-2 border-red-600">
                            1
                         </div>
                         <div class="w-24 h-24 flex items-center justify-center bg-blue-500 border-solid border-2 border-red-600">
                            1
                         </div>
                         <div class="w-24 h-24 flex items-center justify-center bg-blue-500 border-solid border-2 border-red-600">
                            1
                         </div>
                         <div class="w-24 h-24 flex items-center justify-center bg-blue-500 border-solid border-2 border-red-600">
                            1
                         </div>
                    </div>
                </div>
            </section>
        </div>
    </body>
</html>

