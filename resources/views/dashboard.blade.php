
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    
    <div class="py-8">
        <div class="max-w-[25vh] max-h-[25vh] mx-auto sm:px-6 lg:px-8">
            <div class="bg-white  shadow-xl sm:rounded-lg">
                <x-welcome />
                {{-- <x-home-body/> --}}
            </div>
        </div>
    </div>
    <div class="py-8">
        <div class="max-w-[25vh] max-h-[25vh] mx-auto sm:px-6 lg:px-8">
            <div class="bg-white  shadow-xl sm:rounded-lg">
                <x-welcome />
                {{-- <x-home-body/> --}}
            </div>
        </div>
    </div>
</x-app-layout>
