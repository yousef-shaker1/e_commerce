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
        $products = Product::where('section_id', $this->sectionId)
            ->where(function($query) {
                $query->where('name', 'like', "%{$this->search}%")
                      ->orWhere('description', 'like', "%{$this->search}%");
            })
            ->paginate(7);

        return view('livewire.search-product', compact('products'));
    }

    public function updatingProducts()
    {
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->dispatch('searchUpdated');
    }

    public function mount($sectionId)
    {
        $this->sectionId = $sectionId;
        $this->search = request()->query('search', $this->search);
    }
}