<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\clothingsection;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class ColthingSection extends Component
{
    use WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $id;
    public $name = [
        'ar' => '',
        'en' => ''
    ];
    public $img;

    public function render()
    {
        $sections = clothingsection::paginate(5);
        return view('livewire.colthing-section', compact('sections'));
    }

    public function rules()
    {
        return [
            'name.*' => 'required|min:2|max:20',
            'img' => 'required|image',
        ];    
    }

    protected function updateRules()
    {
        return [
            'name.*' => 'nullable|min:2|max:20',
            'img' => 'nullable',
        ];
    }

    public function updated($fields)
    {
        return $this->validateOnly($fields);
    }

    public function editSection(int $id)
    {
        $section = clothingsection::find($id);
        if($section){
            $this->name = $section->getTranslations('name');//['ar', 'en']
            $this->img = $section->img;
            $this->id = $section->id;
        } else {
            return redirect()->back();
        }
    }

    public function deleteSection(int $id)
    {
        $section = clothingsection::find($id);
        if($section){
            $this->name = $section->name;
            $this->id = $section->id;
        } else {
            return redirect()->back();
        }
    }


    public function saveSection(){
        $validateData = $this->validate();
        $path = $this->img->store('section', 'public');

        clothingsection::create([
            'img' => $path,
            'name' => $validateData['name'],
        ]);
        session()->flash('message', 'section created Successfully');
        $this->dispatch('close-modal');
    }

    public function updateSection()
    {
        $validator = $this->validate($this->updateRules());
        $section = clothingsection::find($this->id);
        if ($this->img instanceof UploadedFile) {
            if (!empty($section->img) && Storage::disk('public')->exists($section->img)) {
                Storage::disk('public')->delete($section->img);
            }
    
            // Store the new image
            $path = $this->img->store('section', 'public');
            $section->img = $path;
        }
        
        // Update section name
        $section->name = $validator["name"];
        $section->save();
    
        session()->flash('message', 'section updated Successfully');
        $this->dispatch('close-modal');
    }

    public function destroyStudent(){
        $section = clothingsection::find($this->id);
        if (!empty($section->img) && Storage::disk('public')->exists($section->img)) {
            Storage::disk('public')->delete($section->img);
        }
        $section->delete();
        session()->flash('message', 'section updated Successfully');
        $this->dispatch('close-modal');
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->img = '';
        $this->name = '';
    }

}
