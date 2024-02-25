
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tigh dark:text-slate-100">
            {{ __('Home') }}
        </h2>
    </x-slot>
    @if (session('message'))
    <div class="alert alert-fail text-red-600">
        *{{ session('message') }}
    </div>
    @endif
    {{-- <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white  shadow-xl sm:rounded-lg">
                <x-welcome />
                <x-home-body/>
            </div>
        </div>
    </div>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-600 shadow-xl sm:rounded-lg">
                <x-welcome />
                <x-home-body/>
            </div>
        </div>
    </div> --}}
    
</x-app-layout>
