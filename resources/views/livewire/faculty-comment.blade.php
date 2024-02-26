<div>

    <h1 class="text-3xl font-bold text-gray-800 dark:text-slate-100">Faculty Comment</h1>
    @foreach ($facuarticomms as $facuarticomm)
        <div>
            <p>{{ $facuarticomm->body }}</p>
            <p>{{$facuarticomm ->user->name}}</p>
        </div>
    @endforeach
    <p>{{}}</p>
    @if (Auth::user()->role_id == 3)
    <form wire:action.prevent='MakeComment'>
        <div class="flex flex-col">
        <textarea name="FacuComment" id="" cols="30" rows="10"></textarea>
        <x-button class="px-20 py-2">Faculty Comment</x-button>
        </div>
    </form>
    @endif




</div>