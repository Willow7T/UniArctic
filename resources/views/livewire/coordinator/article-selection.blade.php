<div>
    <div class="flex flex-row justify-between">
        <div class="flex flex-col gap-5">
            <div>
                <h3 class="pb-4 font-bold text-md">Unreleased Monthly Issue</h3>
                <x-alert type="mag" class="bg-green-400 text-green-100 p-4" />
                <div class="flex flex-col ml-3 h-96 gap-y-3 overflow-scroll">
                    @foreach ($magazines as $magazine )
                    <div class="flex flex-row bg-slate-300 dark:bg-slate-800 justify-between">
                        <div>
                            <img class="w-28"
                                src="{{asset('storage/'. $magazine->image ?? 'storage/background/SampleMag.jpg')}}"
                                alt="Magazine Logo">
                        </div>
                        <div class="flex flex-col w-64 ml-4 my-4">
                            <h4>Issue name: {{$magazine->issue_name }}</h4>
                            <p>Publication: {{ DateTime::createFromFormat('!m', $magazine->month)->format('F') }} {{$magazine->year }}</p>
                            <p>Article Count: {{$magazine->articles->count()}}</p>

                                <label for="selected_magazine_{{$magazine->id}}" id="magazine_{{$magazine->id}}"
                                    class="bg-gray-500 text-center flex items-center justify-center h-16" wire:ignore>Select</label>
                                <input type="checkbox" name="selected_magazine_{{$magazine->id}}" wire:model.live="magazine_ids"
                                    value="{{$magazine->id}}" id="selected_magazine_{{$magazine->id}}" class="hidden"
                                    onchange="changeBackground(this, 'magazine_{{$magazine->id}}')">
                        </div>
                            
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-5">
            <div>
                <h3 class="pb-4 font-bold text-md">Unselected Articles</h3>
                <x-alert type="select" class="bg-green-400 text-green-100 p-4" />
                <div class="flex flex-col h-96 gap-y-3 overflow-scroll">
                    @foreach ($articles as $article )
                    <div class="flex flex-row bg-slate-300 dark:bg-slate-800 justify-between">
                        <a href="{{ route('article.show', ['id' => $article->id, 'title' => Str::slug($article->title)]) }}">
                            <div>
                                <img class="h-40"
                                    src="{{asset('storage/'. $article->image ?? 'storage/background/SampleMag.jpg')}}"
                                    alt="article Logo">
                            </div>
                            
                        </a>
                        <div class="flex flex-col w-48 ml-4 my-4">
                            <h4>Title: {{ $article->title }}</h4>
                            <p>Student Author: {{ $article->author->name }}</p>
                            <label for="selected_article_{{$article->id}}" id="article_{{$article->id}}"
                                class="bg-gray-500 text-center flex items-center justify-center h-16">Select</label>
                            <input type="checkbox" wire:model="article_ids" name="selected_article_{{$article->id}}"
                                value="{{$article->id}}" id="selected_article_{{$article->id}}" class="hidden"
                                onchange="changeBackground(this, 'article_{{$article->id}}')">
                        </div>
                       
                    </div>
                    @endforeach
                </div>
            </div>
            <x-button name="tester" wire:click="MakeSelection()">Make Selection</x-button>
        </div>
        <div class="flex flex-col gap-5">
            <div>
                <h3 class="pb-4 font-bold text-md">Articles for Publication</h3>
                <x-alert type="unselect" class="bg-green-400 text-green-100 p-4" />
                <div class="flex flex-col mr-3 h-96 gap-y-3 overflow-scroll">
                    @foreach ($unarticles as $unarticle )
                    <div class="flex flex-row bg-slate-300 dark:bg-slate-800 justify-between">
                        <a href="{{ route('article.show', ['id' => $unarticle->id, 'title' => Str::slug($unarticle->title)]) }}">
                            <div>
                                <img class="h-40"
                                    src="{{asset('storage/'. $unarticle->image ?? 'storage/background/SampleMag.jpg')}}"
                                    alt="unarticle Logo">
                            </div>
                        </a>
                        <div class="flex flex-col w-48 ml-4 my-4">
                            <h4>Title: {{ $unarticle->title }}</h4>
                            <p>Student Author: {{ $unarticle->author->name }}</p>
                            <label for="selected_unarticle_{{$unarticle->id}}" id="unarticle_{{$unarticle->id}}"
                                class="bg-gray-500 text-center flex items-center justify-center h-16">Select</label>
                                <input type="checkbox" wire:model="unarticle_ids" name="selected_unarticle_{{$unarticle->id}}"
                                value="{{$unarticle->id}}" id="selected_unarticle_{{$unarticle->id}}" class="hidden"
                                onchange="changeBackground(this, 'unarticle_{{$unarticle->id}}')">
                        </div>       
                    </div>
                    @endforeach
                </div>
            </div>
                <x-button name="tester" wire:click="UndoSelection()">Undo Selection</x-button>
        </div>
    </div>
</div>
<script>
    function changeBackground(checkbox, labelId) {
        var label = document.getElementById(labelId);
        if (checkbox.checked) {
            label.classList.remove('bg-gray-500');
            label.classList.add('bg-[#007bff]', 'dark:bg-[#5a32a3]');  
        } else {
            label.classList.remove('bg-[#007bff]', 'dark:bg-[#5a32a3]');
            label.classList.add('bg-gray-500');
        }
    }
</script>