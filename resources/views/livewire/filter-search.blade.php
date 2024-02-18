<div>
    {{-- <div class="fixed"> --}}
    
    <div class="2xl:fixed z-50 block md:flex sm:flex">
        <form id="searchForm" wire:submit.prevent="$refresh"class="z-10" >
            <div class="flex flex-row gap-x-4 p-2">
                <input class="border-gray-100 border-2 dark:bg-slate-800 dark:text-slate-100 dark:border-slate-200 
                focus:outline-none focus:border-blue-800 focus:ring-blue-800 dark:focus:border-purple-600 dark:focus:ring-purple-600
                 hover:border-blue-600 rounded-md sm:text-sm dark:hover:border-purple-600
                " type="text" wire:model="search" placeholder="Search by title">
                <x-button type="submit">
                    Search
                </x-button>
            </div>                 
            <div class="flex flex-row gap-x-6 pl-2">    
                <div class="w-max-24 w-32 h-5 px-4 py-6  ">
                    <h3 class="-mx-2 -my-3 flow-root">
                        <!-- Expand/collapse section button -->
                            <button wire:click="toggleMonth" type="button" class="
                            flex w-full items-center justify-between bg-white px-2 dark:bg-slate-800 text-gray-400 
                            hover:text-gray-500 
                            "aria-controls="filter-section-mobile-0">
                                <span class="font-medium text-gray-900  dark:text-gray-100">Month</span>
                                <span class="ml-6 flex items-center">
                                    <!-- Expand icon, show/hide based on section open state. -->
                                    <svg class="h-5 w-5 expand-icon" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                                    </svg>
                                    <!-- Collapse icon, show/hide based on section open state. -->
                                    <svg class="h-5 w-5 collapse-icon" style="display: none;" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H4.75A.75.75 0 014 10z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </button>
                    </h3>
                    <!-- Filter section, show/hide based on section state. -->
                    <div class="pt-8 " id="filter-section-mobile-0" style="display: {{ $isMonthExpanded ? 'block' : 'none' }}">
                        <div class="space-y-6 rounded bg-gray-200 dark:bg-slate-700 p-2">
                            @foreach ($monthList as $m)
                            <div class="flex items-center">
                                <input id="filter-mobile-color-{{ $loop->index }}" type="checkbox" wire:model.live="months" value="{{ $m }}"  class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                <label for="filter-mobile-color-{{ $loop->index }}" class="ml-3 min-w-0 flex-1 text-gray-500 dark:text-gray-100">{{ $m }}</label>
                            </div>
                             @endforeach
                        </div>
                    </div>
                </div>    
                <div class="w-max-24 w-32 h-5 px-4 py-6  ">
                    <h3 class="-mx-2 -my-3 flow-root">
                            <!-- Expand/collapse section button -->
                            <button wire:click="toggleYear" type="button" class="
                            flex w-full items-center justify-between bg-white dark:bg-slate-800 px-2  text-gray-400 
                            hover:text-gray-500 
                            "aria-controls="filter-section-mobile-1">
                                <span class="font-medium text-gray-900 dark:text-gray-100">Year</span>
                                <span class="ml-6 flex items-center">
                                    <!-- Expand icon, show/hide based on section open state. -->
                                    <svg class="h-5 w-5 expand-icon" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                                    </svg>
                                    <!-- Collapse icon, show/hide based on section open state. -->
                                    <svg class="h-5 w-5 collapse-icon" style="display: none;" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H4.75A.75.75 0 014 10z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </button> 
                    </h3>
                    <!-- Filter section, show/hide based on section state. -->
                    <div class="pt-10" id="filter-section-mobile-1" style="display: {{ $isYearExpanded ? 'block' : 'none' }}">
                        <div class="space-y-6 rounded bg-gray-200 dark:bg-slate-700 p-2">
                            @foreach ($yearList as $y)
                            <div class="flex items-center">
                                <input id="filter-mobile-color-{{ $loop->index }}" type="checkbox" wire:model.live="years" value="{{ $y }}" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 ">
                                <label for="filter-mobile-color-{{ $loop->index }}" class="ml-3 min-w-0 flex-1 text-gray-500 dark:text-gray-100">{{ $y }}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="w-max-24 w-32 h-5 px-4 py-6  ">
                    <h3 class="-mx-2 -my-3 flow-root">
                            <!-- Expand/collapse section button -->
                            <button wire:click="toggleFaculty" type="button" class="
                            flex w-full items-center justify-between bg-white dark:bg-slate-800 px-2  text-gray-400 
                            hover:text-gray-500 
                            "aria-controls="filter-section-mobile-2">
                                <span class="font-medium text-gray-900 dark:text-gray-100">Faculty</span>
                                <span class="ml-6 flex items-center">
                                    <!-- Expand icon, show/hide based on section open state. -->
                                    <svg class="h-5 w-5 expand-icon" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                                    </svg>
                                    <!-- Collapse icon, show/hide based on section open state. -->
                                    <svg class="h-5 w-5 collapse-icon" style="display: none;" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H4.75A.75.75 0 014 10z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </button> 
                    </h3>
                    <!-- Filter section, show/hide based on section state. -->
                    <div class="pt-10" id="filter-section-mobile-2" style="display: {{ $isFacultyExpanded ? 'block' : 'none' }}">
                        <div class="space-y-6 rounded bg-gray-200 dark:bg-slate-700 p-2">
                            @foreach ($facultyList as $f)
                            <div class="flex items-center">
                                <input id="filter-mobile-color-{{ $loop->index }}" type="checkbox" wire:model.live="faculties" value="{{ $f }}" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 ">
                                <label for="filter-mobile-color-{{ $loop->index }}" class="ml-3 min-w-0 flex-1 text-gray-500 dark:text-gray-100">{{ $f }}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                
            </div>
        </form>
     </div>
    
     <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-y-4">
            <div class="bg-gray-100">
                @foreach ($articles as $article)
                <a href="{{ route('article.show', ['id' => $article->id, 'title' => Str::slug($article->title)]) }}" class="block max-h-[15%]">
                    <div class="bg-gray-200 m-4 p-4 rounded">
                        <div class="mb-4">
                            @if($article->image)
                            <img class="w-[45rem] xl:h-80 md:h-64 lg:h-64 sm:h-64 mx-auto rounded" src="{{ asset('storage/' . $article->image) }}" alt="Article Image">
                            @else
                            <img class="xl:h-96 md:h-64 lg:h-64 sm:h-20 mx-auto rounded" src="{{ asset('background/blank.png') }}" alt="Blank image">
                            @endif
                            <div class="text-2xl"> 
                                <h2>{{ $article->title }}</h2>
                            </div>
                            
                        </div>
                        <div class="text-base">
                            {{  \Illuminate\Support\Str::words($article->intro, 30)  }}
                        </div>
                        
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
    
    

    

    {{ $articles->links('pagination-links') }}
</div>



