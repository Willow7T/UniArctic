<div>
    <div class="p-2">
        <div class="h-[34rem] lg:grid lg:grid-cols-4 justify-between">
            <div class="flex flex-col gap-6 col-span-1">
                {{-- Add new Faculty --}}
                <div class="h-[15rem] m-4 w-fill">
                    <h1 class="pl-2 font-bold">
                        Add New Faculty
                    </h1>
                    <div class="mt-2">
                        <div class="flex flex-col">
                            <div class="flex flex-row">
                                <input wire:model="name" type="name" class="border border-blue-600 rounded-l "
                                    placeholder="Faculty Name">
                                <x-button wire:click="addFaculty" class="border border-blue-600 p-1
                                 text-white rounded-r rounded-none">
                                 Add New Faculty
                                </x-button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Update Faculty --}}
                <div>
                    <h1 class="pl-2 font-bold ml-10 p-4 text-left">
                        Update a Faculty
                    </h1>
                    <div class="flex flex-row">
                        <div class="flex flex-col">
                            <select class="border border-slate-500 w-60 ml-10" wire:model="updateName">
                                @foreach($faculties as $faculty)
                                    <option value="{{ $faculty->name }}">{{ $faculty->name }}</option>
                                @endforeach
                            </select>
                            <input type="text" class="border border-slate-500 w-60 ml-10" wire:model="newName" placeholder="New Faculty Name">    
                        </div>
                        <x-button wire:click="updateFaculty" class="border border-blue-600 p-1
                                         text-white rounded-r rounded-none">
                                         Update
                        </x-button>
                    </div>
                </div>
            </div>
            <div class="col-span-1 flex-col">
                <h1 class="pl-2 font-bold p-4 ">
                    Facutly List
                </h1>
                <table class="border-collapse border border-slate-500 w-fit">
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
            </div>
            <div class="col-span-2">
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