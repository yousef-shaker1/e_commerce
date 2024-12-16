<?php

namespace App\Livewire;

use App\Models\size;
use Livewire\Component;
use Livewire\WithPagination;

class ShowSize extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $id;
    public $size;
    public $search;

    public function render()
    {
        $sizes = size::where('size', 'like', "%{$this->search}%")->paginate(7);
        return view('livewire.show-size', compact('sizes'));
    }

    public function updatedSearch()
    {
        $this->dispatch('searchUpdated');
    }

    public function rules(){
        return [
            'size' => 'required|min:1|max:10',
        ];
    }
    
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }
    
    public function saveSize()
    {
        $valisatedData = $this->validate();
        size::create($valisatedData);
        $this->resetInput();
        session()->flash('message','size created Successfully');
        $this->dispatch('close-modal');
    }
    
    public function deleteSize(int $id)
    {
        $size = size::find($id);
        $this->id = $id;
        $this->size = $size->size;
    }

    public function destroySize()
    {
        size::find($this->id)->delete();
        session()->flash('delete','size Deleted Successfully');
        $this->dispatch('close-modal');
    }
    
    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->id = '';
        $this->size = '';
    }
}
