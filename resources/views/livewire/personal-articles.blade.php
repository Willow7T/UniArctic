<div>
    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-y-4">
            <div class="bg-gray-200 dark:bg-slate-900 dark:border-slate-900  dark:text-slate-100">
                @foreach ($articles as $article)
                <a href="{{ route('article.show', ['id' => $article->id, 'title' => Str::slug($article->title)]) }}" class="block max-h-[15%]">
                    @if ($article->published==1)
                        <div class="bg-green-300 m-4 p-4 rounded dark:bg-green-500 dark:border-slate-900  dark:text-slate-100">

                    @else
                        <div class="bg-red-400 m-4 p-4 rounded dark:bg-red-700 dark:border-slate-900  dark:text-slate-100">

                    @endif
                        <div class="mb-4">
                            <div class="mb-6">
                                @if($article->image)
                                    <img class="w-[35rem] h-72 mx-auto rounded" src="{{ asset('storage/' . $article->image) }}" alt="article Image">
                                @else
                                    <img class="xl:h-96 md:h-64 lg:h-64 sm:h-20 mx-auto rounded" src="{{ asset('background/blank.png') }}" alt="Blank image">
                                @endif
                            </div>
                            <div class="text-2xl"> 
                                <h2>{{ $article->title }}</h2>
                            </div>
                        </div>
                        <div class="text-base">
                            {{ \Illuminate\Support\Str::words($article->intro, 30) }}
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
    {{ $articles->links(data: ['scrollTo' => false]) }}
</div>
