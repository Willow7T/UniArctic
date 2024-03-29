<div>
    <div class="p-2">
        <div>
            <h1 class="pl-2 font-bold text-center p-4">
                Edit users Role
            </h1>
            <x-alert type="message" class="bg-green-700 text-green-100 p-4" />
            <x-alert type="error" class="bg-red-700 text-red-100 p-4" />
            <x-alert type="notice" class="bg-yellow-300 text-red-100 p-4" />
        </div>
        <div class="h-[36rem] overflow-x-scroll">
            <table class="border-collapse border border-slate-500 w-fit m-auto">
                <thead>
                    <tr class="h-10">
                        <th class="border border-slate-600 ">Name</th>
                        <th class="border border-slate-600 ">Email</th>
                        <th class="border border-slate-600 ">Change Role</th>
                        {{-- <th class="border border-slate-600 ">Role</th> --}}
                        <th class="border border-slate-600 ">Change Faculty</th>
                        {{-- <th class="border border-slate-600 ">Faculty</th> --}}
                        <th class="border border-slate-600 ">Account Creation Date</th>
                        <th class="border border-slate-600 ">Articles Upload</th>
                        <th class="border border-slate-600 ">Check Articles</th>
                        <th class="border border-slate-600 ">Download Student Articles as Zip</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $index => $user)
                    <tr class="{{ $index % 2 == 0 ? ' bg-gray-200 dark:bg-slate-800' : 'bg-white dark:bg-slate-900' }}">
                        <td class="border border-slate-600 text-center p-4 ">{{ $user->name }}</td>
                        <td class="border border-slate-600 text-center p-4 ">{{$user->email}}</td>
                        <td class="border border-slate-600 text-center p-4 ">
                            <select wire:change="updateUserRole({{ $user->id }}, $event.target.value)"
                                class=" block w-auto py-2 px-3 border-0   outline-none focus:ring-0 dark:text-slate-10 {{ $index % 2 == 0 ? ' bg-gray-200 dark:bg-slate-800' : 'bg-white dark:bg-slate-900' }}">
                                @foreach($roles as $role)
                                <option class="" value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{
                                    $role->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        {{-- <td class="border border-slate-600 text-center p-4 ">{{ $user->role->name }} </td> --}}
                        <td class="border border-slate-600 text-center p-4 ">
                            <select wire:change="updateUserFaculty({{ $user->id }}, $event.target.value)"
                                class=" block w-auto py-2 px-3 border-0 outline-none focus:ring-0 dark:text-slate-100 {{ $index % 2 == 0 ? ' bg-gray-200 dark:bg-slate-800' : 'bg-white dark:bg-slate-900' }}">
                                <option value="">No Faculty</option>
                                @foreach($faculties as $faculty)
                                <option value="{{ $faculty->id }}" {{ $user->faculty_id == $faculty->id ? 'selected' :
                                    '' }}>{{ $faculty->name}}</option>
                                @endforeach
                            </select>
                        </td>
                        {{-- <td class="border border-slate-600 text-center p-4 ">{{ optional($user->faculty)->name ?? 'No
                            Faculty' }}</td> --}}
                        <td class="border border-slate-600 text-center p-4 ">{{ $user->created_at ?? 'Data Deleted or
                            Nothing to Show' }}</td>
                        <td class="border border-slate-600 text-center p-4 ">{{ $user->articles_count ?? 'No Article Upload'
                            }}</td>
                        <td class="border border-slate-600 text-center p-4 ">
                            <x-button wire:click="buttonClicked({{$user->id}})" data-modal-target="default-modal"
                                data-modal-toggle="default-modal" class="" type="button">
                                Check
                            </x-button>
                        </td>
                        <td class="border border-slate-600 text-center p-4 ">
                            <div wire:loading wire:target="download">
                                <x-button disabled>
                                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Wait a while
                                </x-button>
                            </div>
                            <div wire:loading.remove wire:target="download">
                                <x-button wire:click="download({{$user->id}})" type="button" name="download">
                                    Download as zip
                                </x-button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pt-2 pr-16">
                {{ $users->links(data: ['scrollTo' => false]) }} 
                {{-- {{ $users->links('pagination-links') }}    --}}

            </div>
        </div>
        <div class="h-[15rem] m-4 w-fill">
            <h1 class="pl-2 font-bold">
                Search with Name
            </h1>
            <div class="mt-2">
                <form wire:submit.prevent="$refresh">
                    @csrf
                    <div class="flex flex-col">
                        <div class="flex flex-row">
                            <input wire:model="search" type="text" class="border border-blue-600 rounded-l "
                                placeholder="Name">
                            <x-button type="submit" class="border border-blue-600 p-1
                         text-white rounded-r rounded-none">
                                Search
                            </x-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div id="default-modal" tabindex="-1" wire:ignore.self aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            User Articles
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="default-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4 w-full">
                        @livewire('coordinator.student-articles')
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <x-button data-modal-hide="default-modal">Done</x-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

