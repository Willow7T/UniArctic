<div>

        <div class="relative px-8">
            <div class="slides-container h-80 flex snap-x snap-mandatory overflow-hidden overflow-x-auto space-x-10 rounded scroll-smooth before:w-[45vw] before:shrink-0 after:w-[45vw] after:shrink-0 md:before:w-0 md:after:w-0">
              @foreach ($magazines as $magazine)
              <div class="slide aspect-square flex-shrink-0 snap-center rounded overflow-hidden bg-white dark:bg-gray-800 dark:text-white
                  shadow-lg shadow-sky-300 hover:shadow-sky-500 dark:shadow-purple-500 dark:hover:shadow-purple-300
                  flex flex-col items-center justify-center w-48 m-2" 
                  wire:click="buttonMagazine({{$magazine->id}})" data-modal-target="default-modal-2" data-modal-toggle="default-modal-2">
                  <img class="w-full h-64 object-cover" src="{{ asset('storage/' . $magazine->image) }}" alt="{{ $magazine->name }}">
                  <h5 class="w-full h-16 text-center mt-2">{{$magazine->issue_name}} {{ DateTime::createFromFormat('!m', $magazine->month)->format('F') }} {{$magazine->year}}</h5>
              </div>
              @endforeach
          </div>
          <div class="absolute top-0 -left-4 h-full items-center hidden md:flex">
            <button role="button" class="prev px-2 py-2 rounded-full bg-neutral-100 text-neutral-900 group" aria-label="prev"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 group-active:-translate-x-2 transition-all duration-200 ease-linear">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
          </button>
          </div>
          <div class="absolute top-0 -right-4 h-full items-center hidden md:flex">
              <button role="button" class="next px-2 py-2 rounded-full bg-neutral-100 text-neutral-900 group" aria-label="next"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 group-active:translate-x-2 transition-all duration-200 ease-linear">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
              </svg>
            </button>
          </div>
      </div>
    
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
