<?php

namespace App\Livewire;

use App\Models\size;
use App\Models\Color;
use Livewire\Component;
use App\Models\Color_Size;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\ColorProduct as ColorProduct;

class ShowSingleColor extends Component
{
    use WithPagination , WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $id;
    public $Color_Product_id;
    public $ColorProduct;
    public $color_id;
    public $color;
    public $image;
    public $search;
    public $sections = [];

    public function render()
    {
        $relationcolors = ColorProduct::whereHas('color', function($query) {
            $query->where('name', 'like', "%{$this->search}%");
        })
        ->where('product_id', $this->id)
        ->get();
        $colors = Color::get();
        $sizes = size::get();
        return view('livewire.show-single-color', compact('relationcolors', 'colors', 'sizes'));
    }

    public function updatedSearch()
    {
        $this->dispatch('searchUpdated');
    }
    
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function mount($id){
        $this->id = $id;
        if (empty($this->sections)) {
            $this->sections[] = [
                'size' => '',
                'price' => '',
                'amount' => ''
            ];
        }
    }

    public function rules(){
        return [
            'color_id' => 'required|min:1|max:10',
            'image' => 'required|image',
            'sections.*.size_id' => 'required',
            'sections.*.price' => 'required|numeric',
            'sections.*.amount' => 'required|numeric',
        ];
    }

    public function saveColor(){
        $validateData = $this->validate();

        $path = $this->image->store('clothingproduct', 'public');

        $color_protuct = ColorProduct::create([
            'product_id' => $this->id,
            'color_id' => $validateData['color_id'],
            'image' => $path,
        ]);

        foreach ($this->sections as $section) {
            Color_Size::create([
                'color_product_id' => $color_protuct->id,
                'size_id' => $section['size_id'],
                'amount' => $section['amount'],
                'price' => $section['price'],
            ]);
        }

        session()->flash('message', 'color created Successfully');
        $this->reset(['color_id', 'image', 'sections']);
        $this->dispatch('close-modal');
    }
    public function closeModal()
    {
        $this->resetInput();
    } 

    public function resetInput()
    {
        $this->color_id = '';
        $this->image = '';
    }


    public function addSection()
    {
        $this->sections[] = [
            'size' => '',
            'price' => '',
            'amount' => ''
        ];
    }
    
    public function removeSection($index)
    {
        unset($this->sections[$index]);
        $this->sections = array_values($this->sections);
    }

    public function delete_Color_Product($id)
    {
        $color = ColorProduct::where('product_id', $this->id)->where('id', $id)->first();
        if($color){
            $this->Color_Product_id = $color->id;
            $this->ColorProduct = $color->color->name;
        } else {
            return redirect()->back();
        }
    }

    public function destroyColor(){
        $color = ColorProduct::where('id', $this->Color_Product_id)->first();
        if(!empty($color->image) && Storage::disk('public')->exists($color->image)){
            Storage::disk('public')->delete($color->image);
        }
        $color->delete();
        session()->flash('message', 'color deleted Successfully');
        $this->dispatch('close-modal');
    }

    // public function deleteColor(int $id)
    // {
    //     $section = section::find($id);
    //     if($section){
    //         $this->name = $section->name;
    //         $this->id = $section->id;
    //     } else {
    //         return redirect()->back();
    //     }
    // }



}
