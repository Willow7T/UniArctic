<?php

namespace App\Livewire\Manager;

use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\User;
use App\Models\Faculty;
use App\Models\Role;
use App\Models\Article;
use ZipArchive;
use DateTime;

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
    public function download($userID)
    {
        // Check if the user is authorized to download the article
        $user = auth()->user();
        if ($user->role_id != 1 && $user->role_id != 2 ) {
            abort(403, 'Unauthorized action.');
        }
        //Get all articles of user
        $articles = Article::where('author_id', $userID)->where('published', true)->get();
        if ($articles->isEmpty()) {
            return session()->flash('notice' , 'No published articles found for this user.');
        }
        $zip = new ZipArchive;
        $zipFileName = storage_path('app/public/' . $userID . '_articles.zip');
        if ($zip->open($zipFileName, ZipArchive::CREATE) === TRUE) {
            // Add each article file to the zip
            foreach ($articles as $article) {
                $filePath = storage_path('app/public/' . $article->content);
                if (file_exists($filePath)) {
                    $issueName = str_replace(' ', '_', $article->magazine->issue_name);
                    $fileName = $user->name . '_' . $issueName.'_'. $article->magazine->year.'_'. DateTime::createFromFormat('!m', $article->magazine->month)->format('F').'_'.'.docx';
                    $zip->addFile($filePath, $fileName);
                }
            }
        
            // Close the zip file
            $zip->close();
        } else {
            abort(500, 'Could not create zip file.');
        }
        
        // Download the zip file
        return response()->download($zipFileName)->deleteFileAfterSend(true);
    }
}
