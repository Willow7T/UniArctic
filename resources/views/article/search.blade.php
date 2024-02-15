<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Search Articles
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form  id="searchForm" method="GET" action="{{ route('article.search') }}">
                        <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search by title">
                        
                           
                        {{-- <select name="months[]" multiple>
                            @foreach ($monthsList as $m)
                            <label>
                                <input type="checkbox" name="months[]" value="{{ $m }}" {{ in_array($m, $months ?? []) ? 'checked' : '' }}>
                                {{ $m }}
                            </label>
                            @endforeach --}}
                                    <button class="w-32 h-8 bg-red-500"type="button">
                                        Select Months
                                    </button>
                                @foreach ($monthList as $m)
                                    <label>
                                        <input type="checkbox" name="months[]" value="{{ $m }}" {{ in_array($m, $months ?? []) ? 'checked' : '' }} onclick="event.stopPropagation()" onchange="submitForm()">
                                        {{ $m }}
                                    </label>
                                @endforeach
                                    <button class="w-32 h-8 bg-red-500"type="button">
                                        Select Years
                                    </button>
                                @foreach ($yearList as $y)
                                    <x-dropdown-link>
                                        <input type="checkbox" name="years[]" value="{{ $y }}" {{ in_array($y, $years ?? []) ? 'checked' : '' }} onclick="event.stopPropagation()" onchange="submitForm()">
                                        {{ $y }}
                                    </x-dropdown-link>
                                @endforeach
                        <button type="submit">Search</button>
                    </form>

                    @foreach ($articles as $article)
                    <a href="{{ route('article.show', ['id' => $article->id, 'title' => Str::slug($article->title)]) }}" class="p-3">
                        <div class="bg-red-500">
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

                    {{ $articles->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>