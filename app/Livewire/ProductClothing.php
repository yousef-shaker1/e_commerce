<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\clothingproduct;
use Livewire\WithPagination;

class ProductClothing extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $filter = 'all'; 

    public function updatedFilter()
    {
        $this->resetPage();
    }

    public function render()
    {
        $clothing_products = $this->filter === 'all' 
            ? ClothingProduct::paginate(9)
            : ClothingProduct::where('type', $this->filter)->paginate(9);
        
        return view('livewire.product-clothing', compact('clothing_products'));
    }
}
