<div class="bg-red-100 ">
    <form class="bg-red-300 justify-center flex gap-x-8" wire:submit.prevent="addComment">
        <input class="w-96" type="text" wire:model.defer="newComment">
        <x-button class=" font-bold text-lg" type="submit">Post</x-button>
    </form>

    <div class="space-y-4">
        @foreach($comments as $comment)
            <div class="pl-4 border-l-2 border-gray-400">
                <p class="mb-2">{{ $comment->body }}</p>
                <x-button class="bg-blue-500 text-white px-2 py-1 rounded" wire:click="showReplyForm({{ $comment->id }})">Reply</x-button>
                @if(isset($newReply[$comment->id]))
                    <form wire:submit.prevent="addReply({{ $comment->id }})">
                        <input type="text" class="mt-2 border rounded p-1 w-full" wire:model="newReply.{{ $comment->id }}">
                        <x-button class="bg-blue-500 text-white px-2 py-1 rounded mt-2" type="submit">Post Reply</x-button>
                    </form>
                @endif
                @foreach($comment->replies as $reply)
                @include('reply', ['reply' => $reply, 'comment' => $comment, 'level' => 1])
            @endforeach
            </div>
        @endforeach
    </div>
</div> 
