<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\clothingproduct;
use App\Models\clothingsection;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ClothingProductAdmin extends Component
{
    use WithPagination, WithFileUploads;
    protected $paginationTheme =             'bootstrap';
    public $id;
    public $name = [
        'ar' => '',
        'en' => ''
    ];
    public $description = [
        'ar' => '',
        'en' => ''
    ];
    public $type = [
        'ar' => '',
        'en' => ''
    ];
    public $img;
    public $price;
    public $amount;
    public $section_id;
    public $search;
    
    public function render()
    {
        $products = clothingproduct::with('section')
        ->where(function ($query) {
            $query->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(name, '$.ar')) LIKE ?", ["%{$this->search}%"])
                ->orWhereRaw("JSON_UNQUOTE(JSON_EXTRACT(name, '$.en')) LIKE ?", ["%{$this->search}%"])
                ->orWhereRaw("JSON_UNQUOTE(JSON_EXTRACT(description, '$.ar')) LIKE ?", ["%{$this->search}%"])
                ->orWhereRaw("JSON_UNQUOTE(JSON_EXTRACT(description, '$.en')) LIKE ?", ["%{$this->search}%"]);
        })
        ->paginate(10);
        $sections = clothingsection::all();
        return view('livewire.clothing-product-admin', compact('products', 'sections'));
    }

    public function updatedSearch()
    {
        $this->dispatch('searchUpdated');
    }

    public function rules()
    {
        return [
            'img' => 'required|image',
            'name.*' => 'required|min:2|max:20',
            'description.*' => 'required|min:5|max:100',
            'price' => 'required',
            'type.en' => 'nullable',
            'type.ar' => 'required',
            'section_id' => 'required|exists:sections,id',
        ];    
    }

    protected function updateRules()
    {
        return [
            'img' => 'nullable',
            'name.*' => 'nullable|min:2|max:20',
            'description.*' => 'nullable|min:5|max:100',
            'price' => 'nullable',
            'type.en' => 'nullable',
            'type.ar' => 'nullable',
            'section_id' => 'nullable',
        ];
    }

    public function updated($fields)
    {
        return $this->validateOnly($fields);
    }

    public function editProduct(int $id)
    {
        $product = clothingproduct::find($id);
        if($product){
            $this->id = $product->id;
            $this->img = $product->img;
            $this->name = $product->getTranslations('name');
            $this->type = $product->getTranslations('type');
            $this->section_id = $product->product_id;
            $this->price = $product->price;
            $this->description = $product->getTranslations('description');
        } else {
            return redirect()->back();
        }
    }

    public function deleteProduct(int $id)
    {
        $product = clothingproduct::find($id);
        if($product){
            $this->name = $product->name;
            $this->id = $product->id;
        } else {
            return redirect()->back();
        }
    }


    public function saveProduct(){
        $validateData = $this->validate();
        $path = $this->img->store('clothingproduct', 'public');
        
        if($validateData['type']['ar'] == 'رجالي'){
            $validateData['type']['en'] = 'man';
        } elseif ($validateData['type']['ar'] == 'حريمي'){
            $validateData['type']['en'] = 'women';
        } elseif($validateData['type']['ar'] == 'اطفالي'){
            $validateData['type']['en'] = 'children';
        }
        clothingproduct::create([
            'img' => $path, 
            'name' => $validateData['name'],
            'price' => $validateData['price'],
            'type' => $validateData['type'],
            'description' => $validateData['description'],
            'section_id' => $validateData['section_id'],
        ]);
        session()->flash('success', 'product created Successfully');
        $this->dispatch('close-modal');
    }

    public function updateProduct()
    {
        $validator = $this->validate($this->updateRules());
        $product = clothingproduct::find($this->id);
        // Check if a new image is provided
        if ($this->img instanceof UploadedFile) {
            // Delete the old image if it exists
            if (!empty($product->img) && Storage::disk('public')->exists($product->img)) {
                Storage::disk('public')->delete($product->img);
            }
    
            // Store the new image
            $path = $this->img->store('clothingproduct', 'public');
            $product->img = $path;
        }
        
        // Update section name
        $product->name = $validator["name"];

        $product->price = $validator['price'];
        $product->description = $validator['description'];
        if($validator['type']['ar'] == 'رجالي'){
            $validator['type']['en'] = 'man';
        } elseif ($validator['type']['ar'] == 'حريمي'){
            $validator['type']['en'] = 'women';
        } elseif($validator['type']['ar'] == 'اطفالي'){
            $validator['type']['en'] = 'children';
        }
        $product->type = $validator['type'];
        $product->section_id = $validator['section_id'] ?? $product->section_id;
        $product->save();
    
        session()->flash('success', 'product updated Successfully');
        $this->dispatch('close-modal');
    }

    public function destroyProduct(){
        $product = clothingproduct::find($this->id);
        if (!empty($product->img) && Storage::disk('public')->exists($product->img)) {
            Storage::disk('public')->delete($product->img);
        }
        $product->delete();
        session()->flash('delete', 'product deleted Successfully');
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
        $this->section_id = '';
        $this->type = '';
        $this->description = '';
        $this->price = '';
    }
}
