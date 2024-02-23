<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('Manager Dashboard') }}
        </h2>
    </x-slot>
    <section class="fixed bg-white/20 right-0 top-28 backdrop-blur-sm">
        {{-- side nav goes here --}}
        
    </section>
    {{-- Charts Panel --}}
    <div class=" py-8 lg:grid lg:grid-cols-6 gap-y-4 dark:text-gray-100 sm:flex sm:flex-col sm:flex-warp">
        <div class="lg:col-span-6">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-slate-900 shadow-xl rounded-lg">
                    <h2 class="text-center text-lg font-bold p-4">Charts</h2>
                    @livewire('charts-panel')
                </div>
            </div>
        </div>
        {{-- User Panel --}}
        <div class="lg:col-span-6">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-slate-900 shadow-xl rounded-lg xl:pb-40">
                    <h2 class="text-center text-lg font-bold p-4">Users</h2>
                    @livewire('manager.manager-user-panel')
                </div>
            </div>
        </div>
        {{-- Chart Panel --}}
       
        <div class="lg:col-span-5">
            <div class="mx-auto sm:px-6 lg:px-8 ">
                <div class="bg-white dark:bg-slate-900 shadow-xl rounded-lg">
                    <h2 class="text-center text-lg font-bold p-4">Articles</h2>
                    {{-- @livewire('manager.admin-userpanel') --}}
                </div>
            </div>
        </div>
        <div class="lg:col-span-5">
            <div class="mx-auto sm:px-6 lg:px-8 ">
                <div class="bg-white dark:bg-slate-900 shadow-xl rounded-lg">
                    <h2 class="text-center text-lg font-bold p-4">Faculties</h2>
                    {{-- @livewire('admin.admin-add') --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>