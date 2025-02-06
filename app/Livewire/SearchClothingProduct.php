<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ClothingProduct;
use Livewire\WithPagination;

class SearchClothingProduct extends Component
{
    use WithPagination;

    public $search = '';
    public $sectionId;
    public $filter = 'all'; // Ensure you have this property for filtering
    protected $paginationTheme = 'bootstrap';

    public function render()
    { 
        // Query with sectionId, search and filter
        $clothing_products = ClothingProduct::where('section_id', $this->sectionId)
            ->where(function($query) {
                $query->where('name', 'like', "%{$this->search}%")
                      ->orWhere('description', 'like', "%{$this->search}%");
            })
            ->when($this->filter !== 'all', function($query) {
                $query->whereJsonContains('type->' . 'ar', $this->filter);
            })
            ->paginate(5);

        return view('livewire.search-clothing-product', [
            'clothing_products' => $clothing_products,
        ]);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function changeFilter($filter)
    {
        $this->filter = $filter;
        $this->resetPage();
    }

    public function mount($sectionId)
    {
        $this->sectionId = $sectionId;
        $this->search = request()->query('search', $this->search);
    }
}