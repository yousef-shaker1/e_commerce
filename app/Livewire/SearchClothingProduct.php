<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ClothingProduct;

class SearchClothingProduct extends Component
{
    public $search = '';
    public $clothing_products = [];
    public $sectionId;

    public function render()
    {
        $this->clothing_products = ClothingProduct::where('name', 'like', "%{$this->search}%")->where('section_id', $this->sectionId)->get();
        return view('livewire.search-clothing-product', ['clothing_products' => $this->clothing_products]);
    }

    public function searchProducts()
    {
        $this->clothing_products = ClothingProduct::where('name', 'like', '%' . $this->search . '%')->get();
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
?>