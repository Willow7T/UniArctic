<?php

namespace App\Livewire\Manager;

use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\User;
use App\Models\Faculty;
use App\Models\Role;
use App\Models\Article;

class ManagerUserPanel extends Component
{
    use WithPagination, WithoutUrlPagination; 

    public $search;

    public function buttonClicked($userId)
    {
        $this->dispatch('userIdUpdated', $userId);
    }

    public function render()
    {
        
        $query = User::query();

        if (!empty($this->search)) {
            $query->whereRaw('LOWER(name) LIKE ?', [strtolower('%' . $this->search . '%')]);
        }
        //fetch all faculties
      
        $users = $query->with('role')
            ->whereNotIn('role_id', [1,2])->orderby('id', 'asc')->paginate(6);

        $users->each(function ($user) {
            $user->articles_count = Article::where('author_id', $user->id)->count();
        });
      

        $faculties = Faculty::all();
        $roles = Role::whereNotIn('id', [1,2])->get();

        return view('livewire.manager.manager-user-panel',//return view with data
            [
                'users' => $users,
                'faculties' => $faculties,
                'roles' => $roles
            ]);
    }

    public function updateUserRole($userId, $roleId)
    {
        $user = User::find($userId);//find user with id
        $user->role_id = $roleId;//overwrite role_id with new value
        $user->save();//save changes
        session()->flash('message', 'User role updated successfully '. $user->name . 'is now a ' .$user->role->name . '');

    }

    public function updateUserFaculty($userId, $facultyId)
    {
        $user = User::find($userId);//find user with id
        $user->faculty_id = $facultyId === "" ? null : $facultyId;//overwrite faculty_id with new value
        $user->save();//save changes
        session()->flash('message', 'User Faculty updated successfully '. $user->name . 'is now from ' .$user->faculty->name . '');


    }
}
