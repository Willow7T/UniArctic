
<div class="p-10 dark:bg-slate-900 dark:border-slate-900 ">

    <div class="flex items-center justify-center mb-8">
        <div class="border-t-4 border-gray-400 flex-grow"></div>
        <div class="mx-4 text-gray-600 dark:text-slate-300">Comment</div>
        <div class="border-t-4 border-gray-400 flex-grow"></div>
    </div>
    

    <form class="justify-center flex gap-x-5" wire:submit.prevent="addComment">
        <textarea placeholder="Write a comment" class="w-96 resize-none rounded-md dark:bg-slate-600" wire:model.defer="newComment"></textarea>
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
                        <div class="flex flex-col">
                            <p class="m-2">Posted by: {{ optional($comment->user)->name }}</p>
                            <p>{{$comment->created_at}}</p>
                        </div>
                    </div>
                        <p class="m-6 border-b dark:border-gray-300">{{ $comment->body }}</p>
                    
                    <div>
                        <x-button class="bg-blue-500 text-white px-2 py-1 rounded m-6" wire:click="showReplyForm({{ $comment->id }})">Reply</x-button>
                    </div>
                    
                </div>
                
                @if(isset($newReply[$comment->id]))
                    <form class="flex gap-x-5 mb-6" wire:submit.prevent="addReply({{ $comment->id }})">
                        <textarea placeholder="Reply to this comment" class="rounded p-1 w-80 resize-none dark:bg-slate-600 dark:focus:border-purple-600" wire:model="newReply.{{ $comment->id }}"></textarea>
                        <x-button class="bg-blue-500 text-white rounded h-14" type="submit">Post Reply</x-button> 
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
