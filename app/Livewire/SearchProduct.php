<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product as ModelsProduct;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


class SearchProduct extends Component
{
    use WithPagination;
    public $search;

    public $sectionId;
    protected $paginationTheme = 'bootstrap';
    // protected $queryString = ['search'];

    public function render()
    {
        $products = ModelsProduct::where('section_id', $this->sectionId)
            ->where('name->ar', 'LIKE', "%{$this->search}%")
            ->orWhere('name->en', 'LIKE', "%{$this->search}%")
            ->orWhere('description->ar', 'LIKE', "%{$this->search}%")
            ->orWhere('description->en', 'LIKE', "%{$this->search}%")
            ->paginate(10);

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
    }
}
