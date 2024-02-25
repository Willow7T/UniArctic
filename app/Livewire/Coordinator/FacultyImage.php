<?php

namespace App\Livewire\Coordinator;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FacultyImage extends Component
{
    use WithFileUploads;

    public $facultyID;
    public $image;

    public function ImageUpload()
    {
        $this->validate([
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2048', // 2MB Max
        ]);

        $imagepath = null;
        if ($this->image) {
            $imagepath = $this->image->store('background', 'public');
            if (!$imagepath) {
                session()->flash('error','Failed to store image');
            }
        }

        // Save the image path to the faculty of the authenticated user
        $user = Auth::user();
        $user->faculty->image = $imagepath;
        $user->faculty->save();
        session()->flash('success','Image uploaded successfully');

        $this->reset('image');
    }


    public function render()
    {
        return view('livewire.coordinator.faculty-image');
    }
}
