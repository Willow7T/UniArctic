{{-- @section('content')
    <div class="article">
        <h2>{{ $article->title }}</h2>
        <p>{{ $article->content }}</p>
        <!-- You can display any other article information here -->
    </div>
@endsection --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif font-semibold text-2xl text-gray-800 leading-tight dark:text-gray-100">
            {{ __($article->title) }}
        </h2>
    </x-slot>
    <div class="py-8">
        <div class="w-7xl max-w-screen-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg dark:bg-slate-900 dark:text-gray-100">
                <div class="article">
                   <div class="flex flex-row w-48 h-14 gap-x-2 pt-4">
                        <div class="flex text-sm border-8 border-transparent rounded-full  focus:outline-none focus:border-gray-300 transition">
                            @if($article->author)
                                <img class="w-10 h-10 rounded-full object-cover" src="{{ $article->author->profile_photo_url }}" alt="{{ $article->author->name }}" />
                            @endif
                        </div>
                        <div class="flex flex-col">
                            <p>{{ $article->author->name ?? 'Anonymous'}}</p>
                            <p>2012 December</p>
                        </div>
                   </div>
                   <div>
                       <!--Add Tags-->
                       <div class="pt-4 pl-8 flex flex-row gap-x-2">
                            @foreach ($article->tags as $tag)
                                <div class="flex flex-row gap-x-2">
                                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                        viewBox="0 0 463.552 463.552" xml:space="preserve" class="fill-blue-500 dark:fill-purple-500 w-5" >
                                    <g>     
                                        <path d="M445.752,256.346l-179.9-180c-9.5-9.5-22.2-14.8-35.6-14.8c-1.1,0-2.2,0-3.3,0.1l-130.1,8.6c-14.1,0.9-25.5,12.3-26.4,26.4
                                            l-3.1,46.2c-6.6-3.8-12.9-8.6-18.6-14.3c-13.9-13.9-22.5-31.2-24.3-48.8c-1.7-16.7,3.1-31.6,13.5-42c22.1-22.1,62.8-17.2,90.9,10.8
                                            c4.7,4.7,12.3,4.7,17,0s4.7-12.3,0-17c-37.6-37.3-93.6-42.1-125-10.7c-15.6,15.6-22.8,37.3-20.4,61.4c2.3,23.1,13.4,45.6,31.2,63.4
                                            c10,10,21.6,17.9,33.9,23.3l-3.8,57.9c-1,14.5,4.4,28.7,14.7,39l180,180c11.4,11.4,26.5,17.6,42.6,17.6l0,0
                                            c16.1,0,31.2-6.3,42.6-17.6l104.3-104.3c11.4-11.4,17.6-26.5,17.6-42.6C463.452,282.746,457.152,267.646,445.752,256.346z
                                             M428.852,324.446l-104.4,104.4c-6.8,6.8-15.9,10.6-25.6,10.6l0,0c-9.7,0-18.8-3.8-25.6-10.6l-180-180c-5.4-5.4-8.2-12.8-7.7-20.4
                                            l3.5-52.4c2,0.3,4,0.6,6,0.8c3,0.3,6,0.5,8.9,0.5c20.5,0,38.8-7.2,52.4-20.8c4.7-4.7,4.7-12.3,0-17s-12.3-4.7-17,0
                                            c-10.4,10.4-25.3,15.2-42,13.5c-2.3-0.2-4.5-0.6-6.7-1l3.6-53.6c0.1-2.2,1.9-3.9,4.1-4.1l130.1-8.6c0.6,0,1.2-0.1,1.8-0.1
                                            c7,0,13.8,2.8,18.7,7.7l179.9,179.9c6.8,6.8,10.6,15.9,10.6,25.6C439.452,308.546,435.652,317.646,428.852,324.446z"/>
                                    </g>
                                    </svg>                                 
                                    <p>{{$tag->name}}</p>
                                </div>
                            @endforeach
                        </div>    
                   </div>
                   <div class="m-8 p-2 text-prett Image-Resizer">
                        <div>{!! $content !!}</div>
                   </div>
                </div>
                @livewire('comment-component', ['article' => $article])
            </div>
        </div>
    </div>
    
</x-app-layout>

