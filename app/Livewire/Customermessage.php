<?php

namespace App\Livewire;

use App\Models\message;
use Livewire\Component;
use Livewire\WithPagination;

class Customermessage extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $id; 
    public $message; 
    public function render()
    {
        $messages = message::paginate(2);
        return view('livewire.customermessage', compact('messages'));
    }

    public function deleteStudent(int $id){
        $message = message::find($id);
        $this->id = $id;
        $this->message = $message->message;
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput(){
        $this->id = '';
        $this->message = '';
    }
    
    public function destroyStudent()
    {
        message::find($this->id)->delete();
        session()->flash('message','message Deleted Successfully');
        $this->dispatch('close-modal');
        return redirect()->back();
    }
}
