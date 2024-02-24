<?php

namespace App\Livewire\Coordinator;


use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\User;
use App\Models\Role;
use App\Models\Article;
use App\Models\Faculty;

// use Illuminate\Support\Facades\DB;

class CoordinatorUserPanel extends Component
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
        $faculty = auth()->user()->faculty;

        if (!empty($this->search)) {
            $query->whereRaw('LOWER(name) LIKE ?', [strtolower('%' . $this->search . '%')]);
        }
        //fetch all faculties
      
        $users = $query->with('role')
            ->whereNotIn('role_id', [1,2,3])
            ->where('faculty_id', $faculty->id)
            ->orderby('id', 'asc')->paginate(6);

        $users->each(function ($user) {
            $user->articles_count = Article::where('author_id', $user->id)->count();
        });
      

        $roles = Role::whereNotIn('id', [1,2,3])->get();
        //$faculties = Faculty::all();

        return view('livewire.coordinator.coordinator-user-panel',//return view with data
            [
                'users' => $users,
                //'faculties' => $faculties,
                'roles' => $roles
            ]);


    }
    public function updateUserRole($userId, $roleId)
    {
        $user = User::find($userId);//find user with id
        $user->role_id = $roleId;//overwrite role_id with new value
        $user->save();//save changes


    }

}
