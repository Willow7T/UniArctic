<nav x-data="{ open: false }"
    class="bg-white/20 border-b backdrop-blur-sm border-gray-200/30 dark:border-gray-900/30 dark:bg-slate-900/10 rounded">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex w-7xl justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('welcome') }}">
                        <x-application-mark class="block h-9 w-auto" />
                    </a>
                </div>
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex justify-between ">
                    <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
                        {{ __('Home') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex justify-between ">
                    <x-nav-link href="{{ route('article.search') }}" :active="request()->routeIs('article.search')">
                        {{ __('Article Search') }}
                    </x-nav-link>
                </div>




            </div>
            <!--button dark swtich-->
            <div class="order-last flex flex-row">
                <div class="flex items-center justify-between relative mb-6">
                    <label for="darkswitch" class="flex items-center cursor-pointer  pt-6">
                        <div class="relative">
                            <input id="darkswitch" type="checkbox" class="sr-only" />
                            <div class="block bg-yellow-300 w-14 h-8  rounded-full"></div>
                            <div
                                class="dot absolute left-1 top-1 bg-white w-6 h-6 rounded-full transition flex items-center justify-center">
                                <svg id="sunIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" class="h-5 w-5 text-yellow-300">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 2v1m0 18v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z">
                                    </path>
                                </svg>
                                <svg id="moonIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5 hidden">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                                </svg>
                            </div>
                    </label>
                </div>
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <!-- Settings Dropdown -->
                    <div class="ms-3 relative">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button
                                    class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="h-11 w-11 rounded-full object-cover"
                                        src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                                @else
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        {{ Auth::user()->name }}

                                        <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </span>
                                @endif
                            </x-slot>

                            <x-slot name="content" class="dark:bg-slate:800">
                                <!-- Account Management -->
                                <div
                                    class="block px-4 py-2 text-xs text-gray-400 dark:text-slate-300 dark:bg-slate-800">
                                    {{ __('Manage Account') }}
                                </div>

                                <x-dropdown-link class="dark:-slate-200" href="{{ route('profile.show') }}">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-dropdown-link>
                                @endif

                                <div class="border-t border-gray-200 dark:border-slate-50"></div>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf

                                    <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
            </div>




            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>


    {{--button for creating articles student acc only--}}
    @if(Route::currentRouteName() != 'admindashboard')
    @if (Auth::user()->role_id == 1)
    <a href="{{ route('admindashboard') }}">
        <div class="absolute right-3 top-[4.75rem] space-x-8 sm:-my-px sm:ms-10 sm:flex">
            <x-button class="bg-blue-500 hover:bg-blue-700">
                Admin Dashboard
            </x-button>
        </div>
    </a>
    @endif
    @endif
    @if(Route::currentRouteName() != 'managerdashboard')
    @if (Auth::user()->role_id == 2)
    <a href="{{ route('managerdashboard') }}">
        <div class="absolute right-3 top-[4.75rem] space-x-8 sm:-my-px sm:ms-10 sm:flex">
            <x-button class="bg-blue-500 hover:bg-blue-700">
                Manager Dashboard
            </x-button>
        </div>
    </a>
    @endif
    @endif
    @if(Route::currentRouteName() != 'coordinatordashboard')
    @if (Auth::user()->role_id == 3)
    @if (Auth::user()->faculty_id)
    <a href="{{ route('coordinatordashboard') }}">
        <div class="absolute right-3 top-[4.75rem] space-x-8 sm:-my-px sm:ms-10 sm:flex">
            <x-button class="bg-blue-500 hover:bg-blue-700">
                Coordinator Dashboard
            </x-button>
        </div>
    </a>
    @else
    <a>
        <div class="absolute right-3 top-[4.75rem] space-x-8 sm:-my-px sm:ms-10 sm:flex">
            <x-button class="bg-blue-500 hover:bg-blue-700" disabled>
                Coordinator Dashboard
            </x-button>
        </div>
    </a>
    @endif
    @endif
    @endif
    @if(Route::currentRouteName() != 'article.create')
    @if (Auth::user()->role_id == 4)
    @if (Auth::user()->faculty_id)
    <a href="{{ route('article.create') }}">
        <div class="absolute right-3 top-[4.75rem] space-x-8 sm:-my-px sm:ms-10 sm:flex">
            <x-button class="bg-blue-500 hover:bg-blue-700">
                Write an Article
            </x-button>
        </div>
    </a>
    @else
    <a>
        <div class="absolute right-3 top-[4.75rem] space-x-8 sm:-my-px sm:ms-10 sm:flex">
            <x-button class="bg-blue-500 hover:bg-blue-700" disabled>
                Write an Article
            </x-button>
        </div>
    </a>
    @endif
    @endif
    @endif





    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
                {{ __('Home') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <div class="shrink-0 me-3">
                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                        alt="{{ Auth::user()->name }}" />
                </div>
                @endif

                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                <x-responsive-nav-link href="{{ route('api-tokens.index') }}"
                    :active="request()->routeIs('api-tokens.index')">
                    {{ __('API Tokens') }}
                </x-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>