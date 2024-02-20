<div>
   <div class="p-2">
    <div>
        <h1 class="pl-2 font-bold ">
            Edit users Role
        </h1>
    </div>
    <div class="h-[34rem] m-4 ml-8 overflow-scroll w-[62rem]">
        <table class="table-fixed border-collapse border border-slate-500 w-fit ">
            <thead>
                 <tr class="h-10">
                   <th class="border border-slate-600">Name</th>
                   <th class="border border-slate-600">Email</th>
                   <th>Change Role</th>
                   <th class="border border-slate-600">Role</th>
                 </tr>
            </thead>
            <tbody>
               @foreach($users as $user)
               <tr>
                   <td class="border-l border-b border-slate-600 text-left border-r border-r-slate-300 ">{{ $user->name }}</td>
                   <td class="border-y border-slate-600 text-center border-x border-x-slate-50 text-pretty">{{$user->email}}</td>
                   <td class="border-y border-slate-600 text-center border-x border-x-slate-50">
                       <select wire:change="updateUserRole({{ $user->id }}, $event.target.value)" class="border border-slate-600 w-10/12 ">
                           @foreach($roles as $role)
                               <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                           @endforeach
                       </select>                                       
                       
                   </td>
                   <td class="border border-slate-600 text-right ">{{ $user->role->name }} </td>
               </tr>
           @endforeach
           </tbody>
       </table>
    </div>
    <div class="flex flex-row justify-between">
        <div class="h-[15rem] m-4 overflow-scroll w-fill">
            <h1 class="pl-2 font-bold">
               Give Users Admin Role
            </h1>
            <div class="mt-2">
                <form wire:submit="addAdminRole" wire:confirm.prompt="Are you sure?\n\nType AdMiN to confirm|AdMiN">
                    <div class="flex flex-col">
                        <div class="flex flex-row">
                            <input wire:model="email_admin" type="email" class="border border-blue-600 rounded-l " placeholder="Email">
                            <x-button type="submit" class="border border-blue-600 p-1
                             text-white rounded-r rounded-none">
                                Add Admin</x-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="h-[15rem] m-4 overflow-scroll w-fill">
            <h1 class="pl-2 font-bold">
               Delete a user
            </h1>
            <div class="mt-2">
                <form wire:submit="deleteUser" wire:confirm.prompt="Are you sure?\n\nType DeLeTe to confirm|DeLeTe">
                    <div class="flex flex-col">
                        <div class="flex flex-row">
                            <input wire:model="email_del" type="email" class="border border-red-600 rounded-l " placeholder="Email">
                            <x-button type="submit" class="border border-red-600 p-1
                             text-white rounded-r rounded-none">
                                Delete User</x-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    

   </div>
</div>