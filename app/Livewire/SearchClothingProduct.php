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

    public function render()
    {
        // استخدام paginate() بدلاً من get()
        $clothing_products = ClothingProduct::where('name', 'like', "%{$this->search}%")
            ->where('section_id', $this->sectionId)
            ->paginate(10);

        return view('livewire.search-clothing-product', [
            'clothing_products' => $clothing_products,
        ]);
    }

    public function searchProducts()
    {
        // استخدام paginate() بدلاً من get()
        $this->clothing_products = ClothingProduct::where('name', 'like', '%' . $this->search . '%')
            ->where('section_id', $this->sectionId)
            ->paginate(10);
    }

    public function updatedSearch()
    {
        $this->searchProducts();
    }

    public function mount($sectionId)
    {
        $this->sectionId = $sectionId;
        $this->search = request()->query('search', $this->search);
    }
}