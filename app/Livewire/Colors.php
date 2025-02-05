<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Color;
use Livewire\WithPagination;

class Colors extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $id;
    public $name = [
        'ar' => '',
        'en' => ''
    ];
    public $search;
    public function render()
    {
        $colors = Color::where('name','like',"%{$this->search}%")->paginate(10);
        return view('livewire.colors',compact('colors'));
    }

    public function updatedSearch()
    {
        $this->dispatch('searchUpdated');
    }

    public function rules(){
        return [
            'name.*' => 'required|min:1|max:30',
        ];
    }
    
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }
    
    public function saveColor()
    {
        $valisatedData = $this->validate();
        Color::create($valisatedData);
        session()->flash('message','color created Successfully');
        $this->dispatch('close-modal');
    }
    
    public function deleteColor(int $id)
    {
        $color = Color::find($id);
        $this->id = $id;
        $this->name = $color->name;
    }

    public function destroyColor()
    {
        Color::find($this->id)->delete();
        session()->flash('delete','Color Deleted Successfully');
        $this->dispatch('close-modal');
    }
    
    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->id = '';
        $this->name = '';
    }
}
