<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use App\Livewire\AdminUserpanel;

class AdminUserpanel extends Component
{
    public $users;
    public $roles;
    public $email_admin;
    public $email_del;

    public function mount()
    {
        
        $this->users = User::with('role')->whereNotIn('role_id', [1])->orderby('id', 'desc')->get();
        $this->roles = Role::whereNotIn('id', [1])->get();

        // Fetch all users except admin
    }

    public function render()
    {
        
        return view('livewire.admin-userpanel');
    }

    public function updateUserRole($userId, $roleId)
    {
        $user = User::find($userId);
        $user->role_id = $roleId;
        $user->save();

        // Fetch all users except admin
        $this->users = User::with('role')->whereNotIn('role_id', [1])->orderby('id', 'desc')->get();

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


        // Fetch all users except admin
        $this->users = User::with('role')->whereNotIn('role_id', [1])->orderby('id', 'desc')->get();
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


        // Fetch all users except admin
        $this->users = User::with('role')->whereNotIn('role_id', [1])->orderby('id', 'desc')->get();
    }
}
