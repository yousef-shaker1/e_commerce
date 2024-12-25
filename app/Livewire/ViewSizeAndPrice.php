<?php

namespace App\Livewire;

use App\Models\size;
use Livewire\Component;
use App\Models\Color_Size;

class ViewSizeAndPrice extends Component
{
    public $id;
    public $Color_Size_Id;
    public $size_id;
    public $size_name;
    public $amount;
    public $price;
    public function render()
    {
        $sizes = Color_Size::with('color_product')->where('color_product_id', $this->id)->get();
        $sizes_all = size::all();
        $color = $sizes->first()?->color_product?->color?->name;//color product
        return view('livewire.view-size-and-price', compact('sizes','sizes_all', 'color'));
    }
    
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function rules(){
        return [
            'size_id' => 'required',
            'price' => 'required|numeric',
            'amount' => 'required|numeric',
        ];
    }

    public function updateRules(){
        return [
            'size_id' => 'nullable',
            'price' => 'nullable|numeric',
            'amount' => 'nullable|numeric',
        ];
    }


    public function saveSize(){
        $data = $this->validate();
        Color_Size::create([
            'color_product_id' => $this->id,
            'size_id' => $data['size_id'],
            'amount' => $data['amount'],
            'price' => $data['price'],
        ]);
        session()->flash('message', 'size created Successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    public function EditSize($id){
        $size = Color_Size::find($id);
        $this->Color_Size_Id = $id;
        $this->size_id = $size->size_id;
        $this->amount = $size->amount;
        $this->price = $size->price;
    }

    public function UpdateSize(){
        $data = $this->validate($this->updateRules());
        $size = Color_Size::find($this->Color_Size_Id);
        $size->update([
            'size_id' => $data['size_id'],
            'amount' => $data['amount'],
            'price' => $data['price'],
        ]);
        session()->flash('message', 'size updated Successfully');
        // $this->resetInput();
        $this->dispatch('close-modal');
    }

    public function DeleteSize($id){
        $size = Color_Size::find($id);
        $this->Color_Size_Id = $id;
        $this->size_name = $size->size->size;
    }

    public function destroySize(){
        $size = Color_Size::find($this->Color_Size_Id);
        $size->delete();
        session()->flash('delete', 'size deleted Successfully');
        $this->dispatch('close-modal');
    }

    public function closeModal()
    {
        $this->resetInput();
    } 

    public function resetInput()
    {
        $this->size_id = '';
        $this->amount = '';
        $this->price = '';
    }
    
}
