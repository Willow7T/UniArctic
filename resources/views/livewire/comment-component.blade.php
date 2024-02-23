<div class="bg-red-100 p-10">
    <form class="bg-red-300 justify-center flex gap-x-8" wire:submit.prevent="addComment">
        <textarea class="w-96 resize-none" wire:model.defer="newComment"></textarea>
        <x-button class=" font-bold text-lg" type="submit">Post</x-button>
    </form>

    <div class="space-y-4">
        @foreach($comments as $comment)
            <div class="pl-4 border-l-2 border-gray-400">
                <div class="grid grid-cols-2 gap-x-2">
                    <div class="col-span-2 flex text-sm border-8 border-transparent  rounded-full  focus:outline-none focus:border-gray-300 transition">
                        @if($comment->user)
                            <img class="w-10 h-10 rounded-full object-cover" src="{{ $comment->user->profile_photo_url }}" alt="{{ $comment->user->name }}" />
                        @endif
                        <p class="m-2">Posted by: {{ optional($comment->user)->name }}</p>

                        </div>
                    <p class="mb-2 bg-red-500">{{ $comment->body }}</p>
                    
                    <div>
                        <x-button class="bg-blue-500 text-white px-2 py-1 rounded" wire:click="showReplyForm({{ $comment->id }})">Reply</x-button>
                    </div>
                    
                </div>
                
                @if(isset($newReply[$comment->id]))
                    <form wire:submit.prevent="addReply({{ $comment->id }})">
                        <textarea class="mt-2 border rounded p-1 w-full resize-none" wire:model="newReply.{{ $comment->id }}"></textarea>
                        <x-button class="bg-blue-500 text-white px-2 py-1 rounded mt-2" type="submit">Post Reply</x-button>
                    </form>
                @endif
                @foreach($comment->replies()->paginate($perPage) as $reply)
                    @include('reply', ['reply' => $reply, 'comment' => $comment, 'level' => 1])
                @endforeach
                @if($comment->replies()->count() > $perPage)
                    <x-button wire:click="loadMore">Load more replies</x-button>
                @endif
            </div>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $comments->links() }}
    </div>
</div> 
