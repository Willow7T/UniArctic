
<div style="padding-left: {{ $level * 20 }}px" class="border-l-2 border-gray-400">
    <p class="mb-2">{{ $reply->body }}</p>
    <x-button class="bg-blue-500 text-white px-2 py-1 rounded" wire:click="showReplyForm({{ $reply->id }})">Reply</x-button>
    @if(isset($newReply[$reply->id]))
        <form wire:submit.prevent="addReply({{ $reply->id }}, {{ $comment->id }})">
            <input type="text" class="mt-2 border rounded p-1 w-full" wire:model="newReply.{{ $reply->id }}">
            <x-button class="bg-blue-500 text-white px-2 py-1 rounded mt-2" type="submit">Post Reply</x-button>
        </form>
    @endif
   @foreach($reply->replies as $nestedReply)
    @include('reply', ['reply' => $nestedReply, 'level' => $level + 1])
@endforeach
</div>