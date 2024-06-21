<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class SearchProduct extends Component
{
    public $search;
    public $sectionId;

    public function render()
    {
        $products = Product::where('name', 'like', "%{$this->search}%")
        ->where('section_id', $this->sectionId)
        ->get();
        return view('livewire.search-product', compact('products'));
    }

    public function searchProducts()
    {
        $this->products = Product::where('name', 'like', '%' . $this->search . '%')->get();
    }


    public function updatedSearch(){
        $this->dispatch('searchUpdated');
    }
    public function mount($sectionId)
    {
        $this->sectionId = $sectionId;
        $this->search = request()->query('search', $this->search);
    }
}