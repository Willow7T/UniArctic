<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('Manager Dashboard') }}
        </h2>
    </x-slot>
    <section class="fixed bg-gray-200/50 p-4 right-0 top-28 backdrop-blur-sm z-30 dark:text-slate-100 dark:bg-slate-900/50">
        {{-- side nav goes here --}}
        <div class="" onmouseover="showNav()" onmouseout="hideNav()">
            <h1>Page Navigation</h1>   
            <ul class="p-3" id="nav" style="display: none;">
                <div class="border-t-4 border-gray-400 "></div>
                <li class="py-2 dark:hover:text-green-400 hover:text-lime-500"><a href="#section1">Charts</a></li>
                <li class="dark:hover:text-green-400 hover:text-lime-500"><a href="#section2">Users</a></li>
                <li class="pb-2 dark:hover:text-green-400 hover:text-lime-500"><a href="#section3">Monthly Issues</a></li>
            </ul>
        </div>      
    </section>
    {{-- Charts Panel --}}
    <div class=" py-8 lg:grid lg:grid-cols-6 gap-y-4 dark:text-gray-100 sm:flex sm:flex-col sm:flex-warp">
        <div class="lg:col-span-6" id="section1">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-slate-900 shadow-xl rounded-lg">
                    <h2 class="text-center text-lg font-bold p-4">Charts</h2>
                    @livewire('charts-panel')
                </div>
            </div>
        </div>
        {{-- Create a Monthly Issues --}}
        <div class="lg:col-span-6" id="section3">
            <div class="mx-auto sm:px-6 lg:px-8 ">
                <div class="bg-white dark:bg-slate-900 shadow-xl rounded-lg">
                    <h2 class="text-center text-lg font-bold p-4">Monthly Issues</h2>
                    @livewire('issue-mag-panel')
                </div>
            </div>
        </div>
        {{-- User Panel --}}
        <div class="lg:col-span-6" id="section2">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-slate-900 shadow-xl rounded-lg ">
                    <h2 class="text-center text-lg font-bold p-4">Users</h2>
                    @livewire('manager.manager-user-panel')
                </div>
            </div>
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