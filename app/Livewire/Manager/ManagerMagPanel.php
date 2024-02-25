<?php

namespace App\Livewire\Manager;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Magazine;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class ManagerMagPanel extends Component
{
    use WithFileUploads;
    use WithPagination;
    use WithoutUrlPagination;

    public $issue_name;
    public $month_year;
    public $image;

    public $magazine_idupdate;
    public $issue_nameupdate;
    public $imageupdate;

    public $status;
    public $search;
    public $year;
    public $month;

    protected $queryString = ['status', 'search', 'months', 'years'];
 


    public function createMagazine()
    {
        try {
            $this->validate([
                'issue_name' => 'required|unique:magazines|max:20',
                'month_year' => 'required',
                'image' => 'required|image|mimes:jpeg,jpg,png|max:2048', // 2MB Max
            ]);

            $imagepath = null;
            if ($this->image) {
                $imagepath = $this->image->store('background', 'public');
                if (!$imagepath) {
                    session()->flash('error', 'Failed to store image');
                }
            }

            $monthYear = explode('-', $this->month_year);
            $month = $monthYear[0];
            $year = $monthYear[1];
            //create new magazine
            $magazine = Magazine::create([
                'issue_name' => $this->issue_name,
                'month' => $month,
                'year' => $year,
                'image' => $imagepath,
                'created_at' => now(),
                'updated_at' => now(),
                
            ]);

            if ($magazine) {
                session()->flash('success', 'Magazine created successfully');
            } else {
                session()->flash('error', 'Failed to create magazine');
            }
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }


        $this->reset('image');
        $this->reset('issue_name');
        $this->reset('month_year');
    }


    public function render()
    {
        // Month & year Logic
        $currentMonth = date('n') + 1;
        $currentYear = date('Y');

        $monthList = [];
        for ($i = 0; $i < 3; $i++) {
            $month = $currentMonth + $i;
            $year = $currentYear;
            if ($month > 12) {
                $month = $month - 12;
                $year++;
            }
            $monthList[] = ['month' => $month, 'year' => $year];
        }




        $query = Magazine::query();

        $status = boolval($this->status);
        $query->where('published', $status);

        if (!empty($this->search)) {
            $query->whereRaw('LOWER(title) LIKE ?', [strtolower('%' . $this->search . '%')]);
        }

        if (!empty($this->month)) {
            $query->where('month', $this->month);
        }

        if (!empty($this->year)) {
            $query->where('year', $this->year);
        }
        $monthMagList = Magazine::distinct()->orderBy('month', 'asc')->pluck('month')->all();
        $yearMagList = Magazine::distinct()->orderBy('year', 'asc')->pluck('year')->all();


        $magazines = $query->select('*')->paginate(5);


        return view(
            'livewire.manager.manager-mag-panel',
            ['monthList' => $monthList, 'monthMagList' => $monthMagList, 'yearMagList' => $yearMagList, 'magazines' => $magazines]
        );
    }

    public function updateMagazine()
    {
        try {
            $this->validate([
                'magazine_idupdate' => 'required|exists:magazines,id',
                'issue_nameupdate' => 'nullable|max:20',
                'imageupdate' => 'nullable|image|mimes:jpeg,jpg,png|max:2048', // 2MB Max
            ]);

            $magazine = Magazine::find($this->magazine_idupdate);

            $imageUpdatePath = null;
            if ($this->imageupdate) {
                if ($magazine->image) {
                    Storage::delete('public/storage/' . $magazine->image);
                }
                $imageUpdatePath = $this->imageupdate->store('background', 'public');
                if (!$imageUpdatePath) {
                    session()->flash('error', 'Failed to update image');
                }
            }

            
            if ($this->imageupdate) {
                $magazine->image = $imageUpdatePath;
            }

            if (!$this->issue_nameupdate == "" || !$this->issue_nameupdate == null) {
                $magazine->issue_name = $this->issue_nameupdate;
            }
            $magazine->save();

            session()->flash('success2', 'Magazine updated successfully.');
        } catch (\Exception $e) {
            session()->flash('error2', $e->getMessage());
        }

        return $this->issue_name;
    }
}
