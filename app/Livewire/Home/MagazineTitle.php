<?php

namespace App\Livewire\Home;

use App\Models\Magazine;
use Livewire\Component;
use Livewire\Attributes\On;

class MagazineTitle extends Component
{
    public $magazineID;

    #[On('magazineIDupdated')] 
    public function updateMagazineId($magID)
    {
    
        $this->magazineID = $magID;
    }
    
    public function render()
    {
        $magazine = Magazine::find($this->magazineID);

        return view('livewire.home.magazine-title', [
            'magazine' => $magazine
            ]);
    }
}
