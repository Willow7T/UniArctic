{{-- @section('content')
    <div class="article">
        <h2>{{ $article->title }}</h2>
        <p>{{ $article->content }}</p>
        <!-- You can display any other article information here -->
    </div>
@endsection --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($article->title) }}
        </h2>
    </x-slot>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <div class="article">
                    <h2>{{ $article->author }}</h2>
                    <p>{{ $article->Intro }}</p>
                    
                    <!-- You can display any other article information here -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

