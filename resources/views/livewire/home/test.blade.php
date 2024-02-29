<div class="min-h-screen bg-neutral-900 text-neutral-50">
	<div id="app" class="max-w-screen-lg mx-auto px-4 md:px-8 py-12 transition-all duration-500 ease-linear">
		<h1 class="font-cabinetGrotesk text-3xl lg:text-4xl font-bold mb-12 leading-tight ">Tailwind CSS Carousel</h1>
		<div class="relative">
			<div class="slides-container h-72 flex snap-x snap-mandatory overflow-hidden overflow-x-auto space-x-2 rounded scroll-smooth before:w-[45vw] before:shrink-0 after:w-[45vw] after:shrink-0 md:before:w-0 md:after:w-0">
				<div class="slide aspect-square h-full flex-shrink-0 snap-center rounded overflow-hidden">
					<img class="w-full h-full object-cover" src="https://images.pexels.com/photos/9754/mountains-clouds-forest-fog.jpg?auto=compress&cs=tinysrgb&w=1600" alt="mountain_image">
				</div>
				<div class="slide aspect-square h-full flex-shrink-0 snap-center rounded overflow-hidden">
					<img class="w-full h-full object-cover" src="https://images.pexels.com/photos/6263568/pexels-photo-6263568.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="mountain_image">
				</div>
				<div class="slide aspect-square h-full flex-shrink-0 snap-center rounded overflow-hidden">
					<img class="w-full h-full object-cover" src="https://images.pexels.com/photos/3026364/pexels-photo-3026364.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="mountain_image">
				</div>
				<div class="slide aspect-square h-full flex-shrink-0 snap-center rounded overflow-hidden">
					<img class="w-full h-full object-cover" src="https://images.pexels.com/photos/10343729/pexels-photo-10343729.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="mountain_image">
                </div>
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
	</div>
</div>


<div class="relative">
    <div class="slides-container h-full sm:h-72 flex snap-x snap-mandatory overflow-hidden overflow-x-auto space-x-10 rounded scroll-smooth before:w-[45vw] before:shrink-0 after:w-[45vw] after:shrink-0 md:before:w-0 md:after:w-0">
      @foreach ($faculties as $faculty)
      <div class="slide aspect-square flex-shrink-0 snap-center rounded overflow-hidden bg-white dark:bg-gray-800 dark:text-white
          shadow-lg shadow-sky-300 hover:shadow-sky-500 dark:shadow-purple-500 dark:hover:shadow-purple-300
          flex flex-col items-center justify-center w-48">
          <div class="relative flex items-center justify-center" wire:click="buttonFaculty({{ $faculty->id }})" data-modal-target="default-modal-1" data-modal-toggle="default-modal-1">
              <img class="w-full h-full object-cover" src="{{ asset('storage/' . $faculty->image) }}" alt="{{ $faculty->name }}">
              <h5 class="w-full h-16 absolute bottom-0 backdrop-blur-lg text-center">{{ $faculty->name }}</h5>
          </div>
      </div>
      @endforeach
  </div>