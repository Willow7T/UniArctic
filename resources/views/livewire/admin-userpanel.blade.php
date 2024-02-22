<div >
    <div class="p-2">
        <div>
            <h1 class="pl-2 font-bold text-center p-4">
                Edit users Role
            </h1>
        </div>
        <div class="h-[34rem] overflow-scroll">
            <table class="border-collapse border border-slate-500 w-fit m-auto">
                <thead>
                    <tr class="h-10">
                        <th class="border border-slate-600 backdrop-blur-sm">Name</th>
                        <th class="border border-slate-600 backdrop-blur-sm">Email</th>
                        <th class="border border-slate-600 backdrop-blur-sm">Change Role</th>
                        <th class="border border-slate-600 backdrop-blur-sm">Role</th>
                        <th class="border border-slate-600 backdrop-blur-sm">Change Faculty</th>
                        <th class="border border-slate-600 backdrop-blur-sm">Faculty</th>
                        <th class="border border-slate-600 backdrop-blur-sm">Account Creation Date</th>
                        <th class="border border-slate-600 backdrop-blur-sm">Articles Upload</th>
                        <th class="border border-slate-600 backdrop-blur-sm">Check Articles</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td class="border border-slate-600 text-center p-4 backdrop-blur-sm">{{ $user->name }}</td>
                        <td class="border border-slate-600 text-center p-4 backdrop-blur-sm">{{$user->email}}</td>
                        <td class="border border-slate-600 text-center p-4 backdrop-blur-sm">
                            <select wire:change="updateUserRole({{ $user->id }}, $event.target.value)"
                                class="backdrop-blur-sm block w-auto py-2 px-3 border-0 outline-none focus:ring-0 dark:bg-slate-900 dark:text-slate-100">
                                @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{
                                    $role->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="border border-slate-600 text-center p-4 backdrop-blur-sm">{{ $user->role->name }} </td>
                        <td class="border border-slate-600 text-center p-4 backdrop-blur-sm">
                            <select wire:change="updateUserFaculty({{ $user->id }}, $event.target.value)"
                                class="backdrop-blur-sm block w-auto py-2 px-3 border-0 outline-none focus:ring-0 dark:bg-slate-900 dark:text-slate-100">
                                <option value="">No Faculty</option>
                                @foreach($faculties as $faculty)
                                <option value="{{ $faculty->id }}" {{ $user->faculty_id == $faculty->id ? 'selected' :
                                    '' }}>{{ $faculty->name}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="border border-slate-600 text-center p-4 backdrop-blur-sm">{{ optional($user->faculty)->name ?? 'No
                            Faculty' }}</td>
                        <td class="border border-slate-600 text-center p-4 backdrop-blur-sm">{{ $user->created_at ?? 'Data Deleted or
                            Nothing to Show' }}</td>
                        <td class="border border-slate-600 text-center p-4 backdrop-blur-sm">{{ $user->articles_count ?? 'No Article Upload'
                            }}</td>
                        <td class="border border-slate-600 text-center p-4 backdrop-blur-sm">
                            <x-button wire:click="buttonClicked({{$user->id}})" data-modal-target="default-modal"
                                data-modal-toggle="default-modal" class="" type="button">
                                Toggle modal
                            </x-button>
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


      
        <div class="flex flex-row justify-between flex-wrap">
              <!-- Add Search Form -->
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
              <!-- Add Admin Role -->
            <div class="h-[15rem] m-4 w-fill">
                <h1 class="pl-2 font-bold">
                    Give Users Admin Role
                </h1>
                <div class="mt-2">
                    <form wire:submit="addAdminRole" wire:confirm.prompt="Are you sure?\n\nType AdMiN to confirm|AdMiN">
                        @csrf
                        <div class="flex flex-col">
                            <div class="flex flex-row">
                                <input wire:model="email_admin" type="email" class="border border-blue-600 rounded-l "
                                    placeholder="Email">
                                <x-button type="submit" class="border border-blue-600 p-1
                             text-white rounded-r rounded-none">
                                    Add Admin
                                </x-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Delete Users -->
            <div class="h-[15rem] m-4 w-fill">
                <h1 class="pl-2 font-bold">
                    Delete a user
                </h1>
                <div class="mt-2">
                    <form wire:submit="deleteUser" wire:confirm.prompt="Are you sure?\n\nType DeLeTe to confirm|DeLeTe">
                        @csrf
                        <div class="flex flex-col">
                            <div class="flex flex-row">
                                <input wire:model="email_del" type="email" class="border border-red-600 rounded-l "
                                    placeholder="Email">
                                <button type="submit" class="
                                inline-flex items-center px-4 py-2 
                                border border-transparent rounded-r font-semibold text-xs text-white uppercase tracking-widest 
                                bg-red-500 dark:text-slate-100 dark:bg-red-700
                                dark:hover:bg-red-600 hover:bg-red-900
                                focus:bg-gray-700 active:bg-gray-900 
                                focus:outline-none focus:ring-2 
                                focus:ring-indigo-500 focus:ring-offset-2 
                                transition ease-in-out duration-150">
                                    Delete User
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Main modal -->
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
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4 w-full">
                        @livewire('admin-student-articles')
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
