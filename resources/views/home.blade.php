<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('Home') }} 
        </h2>
    </x-slot>
    <section class="fixed bg-gray-200/50 p-4 right-0 top-28 backdrop-blur-sm z-30 dark:text-slate-100 dark:bg-slate-900/50">
        {{-- side nav goes here --}}
        <div class="" onmouseover="showNav()" onmouseout="hideNav()">
            <h1>Page Navigation</h1>   
            <ul class="p-3" id="nav" style="display: none;">
                <div class="border-t-4 border-gray-400 "></div>
                <li class="py-2 dark:hover:text-green-400 hover:text-lime-500"><a href="#section1">Faculties</a></li>
                <li class="pb-2 dark:hover:text-green-400 hover:text-lime-500"><a href="#section2">Published Magazines</a></li>
                <li class="pb-2 dark:hover:text-green-400 hover:text-lime-500"><a href="#section3">News Letter</a></li>
            </ul>
        </div>      
    </section>
    {{-- Charts Panel --}}
    <div class=" py-8 lg:grid lg:grid-cols-6 gap-y-4 dark:text-gray-100 sm:flex sm:flex-col sm:flex-warp">
        <div class="lg:col-span-6" id="section1">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-slate-900 shadow-xl rounded-lg">
                    <h2 class="text-center text-lg font-bold p-4">Faculties</h2>
                    @livewire('home.faculty-filter-search')
                </div>
            </div>
        </div>
        {{-- User Panel --}}
        <div class="lg:col-span-6" id="section2">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-slate-900 shadow-xl rounded-lg">
                    <h2 class="text-center text-lg font-bold p-4">Published Monthly Issues</h2>
                    @livewire('home.magazine-filter-search')
                </div>
            </div>
        </div>
           
        <div class="lg:col-span-1 lg:block">
            
        </div>
        <div class="lg:col-span-4" id="section2">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-slate-900 shadow-xl rounded-lg">
                    <h2 class="text-center text-lg font-bold p-4">Published Magazines</h2>
                    @livewire('home.newsletter-send')
                </div>
            </div>
        </div>
        <div class="lg:col-span-1 hidden lg:block">

        </div>
    </div>
    <div  class="bg-white dark:bg-slate-900 shadow-xl rounded-lg p-10">
        @include('footer')
    </div>
</x-app-layout>

<script>
    function showNav() {
        document.getElementById("nav").style.display = "block";
    }

    function hideNav() {
        document.getElementById("nav").style.display = "none";
    }
</script>