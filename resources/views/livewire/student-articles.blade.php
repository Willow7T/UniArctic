<div>
    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-y-4">
            <div class="bg-gray-100 dark:bg-slate-900 dark:border-slate-900  dark:text-slate-100">
                <div class="font-bold text-lg bg-gray-50 dark:bg-slate-900 gap-2 w-[28%] flex flex-row justify-between fixed ">
                    <p>{{ isset($user->name) ? $user->name : 'Default' }}</p>
                    <div>
                        <p class="text-green-600">Published:{{$publishedCount}}</p>
                        <p class="text-red-600">Unpublish:{{$unpublishedCount}}</p>
                    </div> 
                </div>

                @foreach ($articles as $article)
                <a href="{{ route('article.show', ['id' => $article->id, 'title' => Str::slug($article->title)]) }}"
                    class="block max-h-[15%]">
                    <div
                        class="bg-gray-200 m-4 p-4 rounded dark:bg-slate-800 dark:border-slate-900  dark:text-slate-100">
                        <div class="mb-4">
                            <div class="mb-6">
                                @if($article->image)
                                <img class="w-[35rem] h-72 mx-auto rounded"
                                    src="{{ asset('storage/' . $article->image) }}" alt="Article Image">
                                @else
                                <img class="xl:h-96 md:h-64 lg:h-64 sm:h-20 mx-auto rounded"
                                    src="{{ asset('background/blank.png') }}" alt="Blank image">
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
</div>