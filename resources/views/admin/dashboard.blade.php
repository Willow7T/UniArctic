<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>
    <div class=" py-8 grid grid-cols-5 gap-5">
        <!--stat table-->
        <div class=" col-span-2">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="bg-red-500 shadow-xl rounded-lg">
                    <h2 class="text-center text-lg">Stats</h2>

                </div>
            </div>
        </div>
        <!--user table-->
        <div class="col-span-3">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="bg-red-500 shadow-xl rounded-lg">
                    <h2 class="text-center text-lg">Users</h2>

                </div>
            </div>
        </div>
        <div class="col-span-5">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="bg-red-500 shadow-xl rounded-lg">
                    <h2 class="text-center text-lg">Users</h2>

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