<div>
    @foreach ($magazines as $magazine )
    <div wire:click="buttonMagazine({{$magazine->id}})" data-modal-target="default-modal-2"
        data-modal-toggle="default-modal-2">
{{-- Write Here for photo use this$magazine->image--}}{{$magazine->issue_name}} {{ DateTime::createFromFormat('!m', $magazine->month)->format('F') }} {{$magazine->year}}

    </div>
    @endforeach
        <div id="default-modal-2" tabindex="-1" wire:ignore.self aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        @livewire('home.magazine-title')
                        
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="default-modal-2">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4 w-full">
                        @livewire('home.magazine-article')
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <x-button data-modal-hide="default-modal-2">Done</x-button>
                    </div>
                </div>
            </div>
        </div>
</div>