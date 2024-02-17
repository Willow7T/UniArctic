
<div style="padding-left: {{ $level + 20 }}px" class="border-l-2 border-gray-400">
    <div class="grid grid-cols-2 gap-x-2">
        <div class="col-span-2 text-sm border-8 border-transparent  rounded-full  focus:outline-none focus:border-gray-300 transition">
            @if($reply->user)
                <img class="w-10 h-10 rounded-full object-cover" src="{{ $reply->user->profile_photo_url }}" alt="{{ $reply->user->name }}" />
            @endif
             <p class="mb-2">Posted by: {{ optional($reply->user)->name }}</p>
        </div>
        <p class="mb-2 bg-red-500">{{ $reply->body }}</p>

        <div>
             <x-button class="bg-blue-500 text-white px-2 py-1 rounded" wire:click="showReplyForm({{ $reply->id }})">Reply</x-button>
        </div>
       
    </div>
    
    @if(isset($newReply[$reply->id]))
        <form wire:submit.prevent="addReply({{ $reply->id }}, {{ $comment->id }})">
            <textarea type="text" class="mt-2 border rounded p-1 w-full resize-none" wire:model="newReply.{{ $reply->id }}"></textarea>
            <x-button class="bg-blue-500 text-white px-2 py-1 rounded mt-2" type="submit">Post Reply</x-button>
        </form>
    @endif
    @foreach($reply->replies()->paginate($perPage) as $nestedReply)
        @include('reply', ['reply' => $nestedReply, 'level' => $level + 1])
    @endforeach
    @if($reply->replies()->count() > $perPage)
        <x-button wire:click="loadMore">Load more replies</x-button>
    @endif


</div>