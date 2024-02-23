<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Role;
use App\Models\Article;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class AdminUserpanel extends Component
{
    use WithPagination, WithoutUrlPagination;
  
    public $email_admin;
    public $email_del;
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
            ->whereNotIn('role_id', [1])->orderby('id', 'asc')->paginate(6);

        $users->each(function ($user) {
            $user->articles_count = Article::where('author_id', $user->id)->count();
        });
      

        $faculties = DB::table('faculties')->get();
        $roles = Role::whereNotIn('id', [1])->get();

        return view('livewire.admin.admin-userpanel',//return view with data
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


    }

    public function updateUserFaculty($userId, $facultyId)
    {
        $user = User::find($userId);//find user with id
        $user->faculty_id = $facultyId === "" ? null : $facultyId;//overwrite faculty_id with new value
        $user->save();//save changes


    }

    public function deleteUser()
    {
        $this->validate([
            'email_del' => 'required|email',
        ]);
        // Find the user by email
        $user = User::where('email', $this->email_del)->first();
        //Check user if Admin
        if(!$user){
        session()->flash('Delete-Failed', 'User not found with this email.');
        }
        else if($user->role_id == 1){
            session()->flash('Delete-Failed', 'User is admin.');
        }
        else {
           // Delete the user
           $user->delete();
            session()->flash('Delete-Success', 'User deleted.');
            // Reset the email input
           $this->email_del = '';
        }


    }


    
    public function addAdminRole()
    {
        
        $this->validate([
            'email_admin' => 'required|email',
        ]);
        // Find the user by email
        $user = User::where('email', $this->email_admin)->first();

        // Check if the user exists
        if (!$user) {
            
            session()->flash('Admin-Fail', 'User not found with this email.');
        }
        else if($user->role_id == 1){
            session()->flash('Admin-Fail', 'User is already admin.');
        }
        else
        {
            $user->role_id = 1; // Role 1 is the role_id for admin
            $user->save();
            session()->flash('Admin-Success', 'User is now admin.');
            // Reset the email input
            $this->email_admin = '';
        }


    }
}
