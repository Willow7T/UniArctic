<div>
    {{-- <div class="fixed"> --}}
        {{ $articles->links() }}
    
    
    <form id="searchForm" wire:submit.prevent="$refresh" >
        <input type="text" wire:model="search" placeholder="Search by title">
            <x-button type="submit">
                Search
            </x-button>
                        
        <div class="flex flex-row gap-x-6">    
            <div class="w-max-24 w-24 border-t border-gray-200 px-4 py-6">
                <h3 class="-mx-2 -my-3 flow-root">
                    <!-- Expand/collapse section button -->
                        <button wire:click="toggleMonth" type="button" class="flex w-full items-center justify-between bg-white px-2 py-3 text-gray-400 hover:text-gray-500" aria-controls="filter-section-mobile-0">
                            <span class="font-medium text-gray-900">Month</span>
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
                <div class="pt-6" id="filter-section-mobile-0" style="display: {{ $isMonthExpanded ? 'block' : 'none' }}">
                    <div class="space-y-6">
                        @foreach ($monthList as $m)
                        <div class="flex items-center">
                            <input id="filter-mobile-color-{{ $loop->index }}" type="checkbox" wire:model.live="months" value="{{ $m }}"  class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                            <label for="filter-mobile-color-{{ $loop->index }}" class="ml-3 min-w-0 flex-1 text-gray-500">{{ $m }}</label>
                        </div>
                         @endforeach
                    </div>
                </div>
            </div>    
            <div class="w-max-24 w-24 border-t border-gray-200 px-4 py-6">
                <h3 class="-mx-2 -my-3 flow-root">
                        <!-- Expand/collapse section button -->
                        <button wire:click="toggleYear" type="button" class="flex w-full items-center justify-between bg-white px-2 py-3 text-gray-400 hover:text-gray-500" aria-controls="filter-section-mobile-1">
                            <span class="font-medium text-gray-900">Year</span>
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
                <div class="pt-6" id="filter-section-mobile-1" style="display: {{ $isYearExpanded ? 'block' : 'none' }}">
                    <div class="space-y-6">
                        @foreach ($yearList as $y)
                        <div class="flex items-center">
                            <input id="filter-mobile-color-{{ $loop->index }}" type="checkbox" wire:model.live="years" value="{{ $y }}" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 ">
                            <label for="filter-mobile-color-{{ $loop->index }}" class="ml-3 min-w-0 flex-1 text-gray-500">{{ $y }}</label>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white  shadow-xl sm:rounded-lg">
                @foreach ($articles as $article)
                <a href="{{ route('article.show', ['id' => $article->id, 'title' => Str::slug($article->title)]) }}" class="p-3">
                    <div class="bg-cyan-500">
                          <h2>{{ $article->title }}</h2>
                            <p>{{ $article->intro }}</p>
                            @if($article->image)
                                <img class="max-w-xs max-h-64" src="{{asset('storage/' . $article->image)  }}" alt="">
                            @else
                                <img class="max-w-xs max-h-64" src="{{ asset('background/blank.png') }}" alt="Blank image">
                            @endif
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>

    

    {{ $articles->links() }}
</div>
