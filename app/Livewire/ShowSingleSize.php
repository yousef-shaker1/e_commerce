<?php

namespace App\Livewire;

use App\Models\size;
use Livewire\Component;
use App\Models\relationsize;

class ShowSingleSize extends Component
{
    public $id;
    public $amount;
    public $size_id;
    public $size_name;
    public $search;

    public function render()
    {
        $relationsizes = relationsize::whereHas('size', function($query) {
            $query->where('size', 'like', "%{$this->search}%");
        })
        ->where('product_id', $this->id)
        ->get();
        $sizes = size::get();
        $product = $this->id;
        return view('livewire.show-single-size', compact('relationsizes', 'sizes', 'product'));
    }

    public function updatedSearch()
    {
        $this->dispatch('searchUpdated');
    }
    public function mount($id)
    {
        $this->id = $id;
    }

    public function rules()
    {
        return [
            'size_id' => 'required',
            'amount' => 'required|max:30',
        ];    
    }



    public function updated($fields)
    {
        return $this->validateOnly($fields);
    }


    public function showSize($id)
    {
        $size = size::find($id);
        if ($size) {
            $this->size_name = $size->size;
            $this->size_id = $size->id;
        } else {
            session()->flash('delete', 'Size not found!');
            return redirect()->back();
        }   
    }

    public function saveSize(){
        $validateData = $this->validate();

        relationsize::create([
            'product_id' => $this->id,
            'size_id' => $validateData['size_id'],
            'amount' => $validateData['amount'],
        ]);
            
        session()->flash('message', 'size created Successfully');
        $this->dispatch('close-modal');
    }

    
    public function destroySize()
    {
        $size = relationsize::where('product_id', $this->id)->where('size_id', $this->size_id);
        if ($size) {
            $size->delete();
            session()->flash('delete', 'Size deleted successfully');
            $this->dispatch('close-modal');
        } else {
            session()->flash('delete', 'Size not found');
        }
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->amount = '';
        $this->size_name = '';
    }
}
