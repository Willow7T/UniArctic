<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>
    <div class=" py-8 grid lg:grid-cols-5 sm:grid-cols-1 gap-5 dark:text-gray-100">
        <!--stat table-->
        <div class=" sm:col-span-1 lg:col-span-2">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-slate-900 shadow-xl rounded-lg">
                    <h2 class="text-center text-lg font-bold">Stats</h2>
                    @livewire('admin-statpanel')
                </div>
            </div>
        </div>
        <!--user table-->
        <div class="sm:col-span-1  lg:col-span-3">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-slate-900 shadow-xl rounded-lg">
                    <h2 class="text-center text-lg font-bold">Users</h2>

                </div>
            </div>
        </div>
        <div class="sm:col-span-1 lg:col-span-5">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-slate-900 shadow-xl rounded-lg">
                    <h2 class="text-center text-lg font-bold">Users</h2>

                </div>
            </div>
        </div>
    </div>
    
    {{-- <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-600 shadow-xl sm:rounded-lg">
                <x-welcome />
                <x-home-body/>
            </div>
        </div>
    </div> --}} 
    
</x-app-layout>