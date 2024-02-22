<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Role;
use App\Models\Article;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use App\Livewire\AdminUserpanel;

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

        return view('livewire.admin-userpanel',
            [
                'users' => $users,
                'faculties' => $faculties,
                'roles' => $roles
            ]);
    }

   
    public function updateUserRole($userId, $roleId)
    {
        $user = User::find($userId);
        $user->role_id = $roleId;
        $user->save();


    }

    public function updateUserFaculty($userId, $facultyId)
    {
        $user = User::find($userId);
       $user->faculty_id = $facultyId === "" ? null : $facultyId;
        $user->save();


    }

    public function deleteUser()
    {
        $this->validate([
            'email_del' => 'required|email',
        ]);
        // Find the user by email
        $user = User::where('email', $this->email_del)->first();
        if ($user) {
            // Delete the user
            $user->delete();
        } else {
            $this->addError('email_del', 'User not found with this email.');
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
            
            $this->addError('email', 'User not found with this email.');
        }
        else
        {
            $user->role_id = 1; // Assuming 1 is the role_id for admin
            $user->save();
            // Reset the email input
            $this->email_admin = '';
        }


    }
}
