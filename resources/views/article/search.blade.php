<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-slate-100 leading-tight">
            Search Articles
        </h2>
    </x-slot>
 @livewire('filter-search')
 <div  class="bg-white dark:bg-slate-900 shadow-xl rounded-lg p-10">
    @include('footer')
</div>
</x-app-layout>


