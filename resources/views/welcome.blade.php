<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="white">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>UniArctic</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.2/css/all.css">
        

        <!-- Scripts -->
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
        {{-- <script src="{{ secure_asset('build/assets/app-DgbtYFve.js') }}"></script> --}} 
        <script src="{{asset('build/assets/app-tCqK36nS.js') }}"></script>

        <!-- Styles -->
        {{-- <link href="{{ secure_asset('build/assets/app-BE0mZvCE.css') }}" rel="stylesheet"> --}}
        <link href="{{asset('build/assets/app-B7hUPDDa.css') }}" rel="stylesheet">
        @livewireStyles
       
    </head>
    <body class="antialiased  dark:bg-slate-900">
       
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
            <div class="mt-16  justify-center px-4 md:mt-12 xl:mt-0 h-svh lg:h-full lg:w-full">
                <div class="relative w-full h-full mt-8 lg:mt-32">
                    <img class="object-cover w-full h-full" src="{{ asset('storage/background/uniback.jpg') }}" alt="Home Image">
                    <div class="absolute top-0 left-0 w-full h-full flex flex-col items-center justify-center space-y-4 z-10">
                        <div class="lg:static grid lg:grid-cols-4  lg:gap-24 grid-cols-2 backdrop-blur-md mb-16">
                            <div class="bg-white bg-opacity-50 p-4 flex flex-col items-center justify-center w-32 h-32 scale-[.8] lg:scale-1">
                                <div class="mb-2">
                                <i class="fa-solid fa-users fa-3x"></i>
                                </div>
                                <p>{{$user}}</p>
                                <p>Users</p>
                            </div>
                            <div class="bg-white bg-opacity-50 p-4 flex flex-col items-center justify-center w-32 h-32 scale-[.8] lg:scale-1">
                                <div class="mb-2">
                                <i class="fa-solid fa-users fa-3x"></i>
                                </div>
                                <p>{{$student}}</p>
                                <p>Students</p>
                            </div>
                            <div class="bg-white bg-opacity-50 p-4 flex flex-col items-center justify-center w-32 h-32 scale-[.8] lg:scale-1">
                                <div class="mb-2">
                                <i class="fa-solid fa-newspaper fa-3x"></i>
                                </div>
                                <p>{{$article}}</p>
                                <p>Articles</p>
                            </div>
                            <div class="bg-white bg-opacity-50 p-4 flex flex-col items-center justify-center w-32 h-32 scale-[.8] lg:scale-1">
                                <div class="mb-2">
                                <i class="fa-solid fa-school fa-3x"></i>
                                </div>
                                <p>{{$faculty}}</p>
                                <p>Faculties</p>
                            </div>
                        </div>
                        <div class="lg:static w-72 backdrop-blur-md bg-white bg-opacity-50 p-4 text-center z-10 scale-[.8] lg:scale-1">
                            <p>Welcome, students, to our informative and engaging article website where knowledge awaits to inspire and enrich your learning journey!</p>
                        </div>
                    </div>
                </div>
            </div>
              
              
        </div>
        <div  class="bg-white dark:bg-slate-900 shadow-xl rounded-lg p-10 mt-8">
            @include('footer')
        </div>
    </body>
</html>

