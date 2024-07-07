<?php

namespace App\Livewire;

use App\Models\section;
use Livewire\Component;
use App\Models\clothingsection;

class Shop extends Component
{
    // public $sections;
    // public $clothing_sections;
    public $search;

    public function render()
    {
        $sections = section::where('name', 'like', "%{$this->search}%")->get();
        $clothing_sections = clothingsection::where('name', 'like', "%{$this->search}%")->get();
        return view('livewire.shop', compact('sections', 'clothing_sections'));
    }
}
