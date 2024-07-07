<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class SearchProduct extends Component
{
    use WithPagination;
    public $search;
    public $sectionId;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $products = Product::where('name', 'like', "%{$this->search}%")->orwhere('description', 'like', "%{$this->search}%")
        ->where('section_id', $this->sectionId)
        ->paginate(8);
        return view('livewire.search-product', compact('products'));
    }

    public function updatingProducts(){
        $this->resetpage();
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