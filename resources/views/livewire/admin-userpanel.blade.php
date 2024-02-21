<div>
   <div class="p-2">
    <div>
        <h1 class="pl-2 font-bold ">
            Edit users Role
        </h1>
    </div>
    <div class="h-[34rem] overflow-scroll m-4 ml-8">
        <table class=" border-collapse border border-slate-500 w-fit ">
            <thead>
                 <tr class="h-10">
                   <th class="border border-slate-600">Name</th>
                   <th class="border border-slate-600">Email</th>
                   <th>Change Role</th>
                   <th class="border border-slate-600">Role</th>
                   <th class="border border-slate-600">Change Faculty</th>
                   <th class="border border-slate-600">Faculty</th>
                   <th class="border border-slate-600">Account Creation Date</th>
                    <th class="border border-slate-600">Articles Upload</th>

                 </tr>
            </thead>
            <tbody>
               @foreach($users as $user)
               <tr>
                   <td class="border border-slate-600 text-left ">{{ $user->name }}</td>
                   <td class="border border-slate-600 text-center text-pretty">{{$user->email}}</td>
                   <td class="border border-slate-600 text-center">
                       <select wire:change="updateUserRole({{ $user->id }}, $event.target.value)" class="border border-slate-600 w-full ">
                           @foreach($roles as $role)
                               <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                           @endforeach
                       </select>                                         
                   </td> 
                   <td class="border border-slate-600 text-right ">{{ $user->role->name }} </td>
                   <td>
                    <select wire:change="updateUserFaculty({{ $user->id }}, $event.target.value)" class="border border-slate-600 w-full ">  
                            <option value="">No Faculty</option>
                        @foreach($faculties as $faculty)
                            <option  value="{{ $faculty->id }}" {{ $user->faculty_id == $faculty->id ? 'selected' : '' }}>{{ $faculty->name}}</option>
                        @endforeach
                    </select>
                   </td>
                    <td class="border border-slate-600 text-center  ">{{ optional($user->faculty)->name ?? 'No Faculty' }}</td>
                    <td class="border border-slate-600 text-center ">{{ $user->created_at ?? 'No Article Upload' }}</td>
                    <td class="border border-slate-600 text-right ">{{ $user->articles_count ?? 'No Article Upload' }}</td>
                   {{-- <td class="border border-slate-600 text-right ">{{ optional($counter->articles_count) ?? 'No Article Upload' }}</td> --}}
                </tr>
                @endforeach
           </tbody>
       </table>
    </div>


    <!-- Add Admin Role -->
    <div class="flex flex-row justify-between">
        <div class="h-[15rem] m-4 w-fill">
            <h1 class="pl-2 font-bold">
               Give Users Admin Role
            </h1>
            <div class="mt-2">
                <form wire:submit="addAdminRole" wire:confirm.prompt="Are you sure?\n\nType AdMiN to confirm|AdMiN">
                    @csrf
                    <div class="flex flex-col">
                        <div class="flex flex-row">
                            <input wire:model="email_admin" type="email" class="border border-blue-600 rounded-l " placeholder="Email">
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
                            <input wire:model="email_del" type="email" class="border border-red-600 rounded-l " placeholder="Email">
                            <button type="submit" class="
                            inline-flex items-center px-4 py-2 
                            border border-transparent rounded-r font-semibold text-xs text-white uppercase tracking-widest 
                            bg-red-500 dark:text-slate-100 dark:bg-red-700
                            dark:hover:bg-red-600 hover:bg-red-900
                            focus:bg-gray-700 active:bg-gray-900 
                            focus:outline-none focus:ring-2 
                            focus:ring-indigo-500 focus:ring-offset-2 
                            transition ease-in-out duration-150">
                            Delete User</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    

   </div>
</div>
