<?php

namespace App\Livewire;

use App\Models\section;
use Livewire\Component;
use App\Models\clothingsection;

class Shop extends Component
{
    public $search;

    public function render()
    {

        $sections = section::get();
        $clothing_sections = clothingsection::get();
        return view('livewire.shop', compact('sections', 'clothing_sections'));
    }
}
