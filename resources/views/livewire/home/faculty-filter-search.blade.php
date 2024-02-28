<div>
    {{-- <div class="flex flex-row">
        @foreach ($faculties as $faculty ) --}}
    {{-- <div wire:click="buttonFaculty({{$faculty->id}})" data-modal-target="default-modal-1"
        data-modal-toggle="default-modal-1">
        {{-- Write Here for photo use this$faculty->image--}}Test
        <img class="w-20" src="{{asset('storage/'.$faculty->image)}}" alt="Imageback">
    </div>
    @endforeach

    
    </div>
        <div id="default-modal-1" tabindex="-1" wire:ignore.self aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        @livewire('home.faculty-title')
                        
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="default-modal-1">
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
                        @livewire('home.faculty-article')
                        {{-- @livewire('specified-articles') --}}
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <x-button data-modal-hide="default-modal-1">Done</x-button>
                    </div>
                </div>
            </div>
        </div>
</div>
<script>
    const config = {
  type: 'carousel',
  startAt: 0,
  perView: 4,
  gap: 32,
  breakpoints: {
    1280: {
      perView: 3,
    },
    1024: {
      perView: 2,
    },
    768: {
      perView: 1,
    }
  }
}
new Glide('.glide', config).mount()
</script>