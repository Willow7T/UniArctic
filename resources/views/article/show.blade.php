{{-- @section('content')
    <div class="article">
        <h2>{{ $article->title }}</h2>
        <p>{{ $article->content }}</p>
        <!-- You can display any other article information here -->
    </div>
@endsection --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif font-semibold text-2xl text-gray-800 leading-tight">
            {{ __($article->title) }}
        </h2>
    </x-slot>
    <div class="py-8">
        <div class="w-7xl max-w-screen-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <div class="article">
                   <div class="flex flex-row w-48 h-14 gap-x-2">
                        <div class="flex text-sm border-8 border-transparent  rounded-full  focus:outline-none focus:border-gray-300 transition">
                          <img class="w-10 h-10 rounded-full object-cover" src="{{ $article->author->profile_photo_url }}" alt="{{ $article->author->name }}" />
                        </div>
                        <div class="flex flex-col">
                            <p>{{ $article->author->name }}</p>
                            <p>2012 December</p>
                        </div>
                   </div>
                   <div class="m-8 p-2 text-pretty Image-Resizer">
                        <div>{!! $content !!}</div>
                   </div>
                   

                   
                    
                    <!-- You can display any other article information here -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

