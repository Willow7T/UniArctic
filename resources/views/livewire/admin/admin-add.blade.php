<div>
    <div class="p-2">
        <div class="h-fit lg:grid lg:grid-cols-4 justify-between">
            <div class="flex flex-col gap-6 col-span-1">
                {{-- Add new Faculty --}}
                <div class="h-[15rem] m-auto w-fill">
                    <h1 class="pl-2 font-bold">
                        Add New Faculty
                    </h1>
                    <div class="mt-2">
                        <div class="flex flex-col">
                            <div class="flex flex-row">
                                <input wire:model="name" type="name" class="border border-blue-600 rounded-l dark:bg-slate-800"
                                    placeholder="   Faculty Name">
                                <x-button wire:click="addFaculty" class="border border-blue-600 
                                 text-white rounded-r rounded-none">
                                 Add New Faculty
                                </x-button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Update Faculty --}}
                <div class="h-[15rem] m-auto w-fill">
                    <h1 class="pl-2 font-bold mb-2">
                        Update a Faculty
                    </h1>
                    <div>
                        <div class="flex flex-row">
                            <div class="flex flex-col">
                                <select class="dark:bg-slate-800 border border-slate-500 w-60" wire:model="updateName">
                                    @foreach($faculties as $faculty)
                                        <option value="{{ $faculty->name }}">{{ $faculty->name }}</option>
                                    @endforeach
                                </select>
                                <input type="text" class="dark:bg-slate-800 border border-slate-500 w-60" wire:model="newName" placeholder="New Faculty Name">    
                            </div>
                            <x-button wire:click="updateFaculty" class="border border-blue-600 p-1
                                             text-white rounded-r rounded-none">
                                             Update
                            </x-button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-1 flex-col">
                <h1 class="pl-2 font-bold p-4 text-center">
                    Facutly List
                </h1>
                <table class="border-collapse border border-slate-500 w-fit m-auto">
                    <thead>
                        <tr class="h-10">
                            <th class="border border-slate-600 backdrop-blur-sm">Name</th>
                            <th class="border border-slate-600 backdrop-blur-sm w-32"> User Count </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($faculties as $faculty)
                        <tr class="h-10">
                            <td class="border border-slate-600 backdrop-blur-sm">{{ $faculty->name }}</td>
                            <td class="border border-slate-600 backdrop-blur-sm text-center">{{ $faculty->users->count()
                                }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                    {{ $faculties->links(data: ['scrollTo' => false]) }}

            </div>
            <div class="col-span-2 mt-6">
                <h1 class="pl-2 font-bold text-center">
                    Faculty Activity Chart
                </h1>
                <div class="pt-2 pr-4">
                    @livewire('charts.faculty-activity-chart')
                </div>
            </div>
        </div>
    </div>
</div>