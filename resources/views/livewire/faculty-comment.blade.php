<div>
    <h1 class="text-3xl font-bold text-gray-800 dark:text-slate-100">Faculty Comment</h1>
    <div class="flex flex-col gap-4 pb-4">
        @foreach ($facuarticomms as $facuarticomm)
        <div class="flex flex-col ">
            <p>{{ $facuarticomm->body }}</p>
            <div class="flex flex-row gap-2">
                <img class="w-10 h-10 rounded-full object-cover" src="{{ $facuarticomm->user->profile_photo_url }}" alt="{{ $facuarticomm->user->name }}" />
                <p class="pt-2">{{$facuarticomm ->user->name}}</p>
            </div>
        </div>
        @endforeach
    </div>

    @if (Auth::user()->role_id == 3 && $article->published == 0 && $article->faculty_id == Auth::user()->faculty_id)
    <form wire:submit.prevent='MakeComment'>
        @csrf
        <div class="flex flex-col">
            <textarea name="facucomment" id="facucomment" wire:model='facucomment' cols="30" rows="10"></textarea>
            <x-button class="px-20 py-2" type="submit" wire:submit>Faculty Comment</x-button>
        </div>
    </form>
    @endif
</div>