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
    protected $paginationTheme = 'bootstrap';
    public $id;
    public $name;
    public $img;
    public $description;
    public $price;
    public $amount;
    public $section_id;
    public $type;
    public $search;
    
    public function render()
    {
        $products = clothingproduct::where('name', 'like', "%{$this->search}%")->orwhere('description', 'like', "%{$this->search}%")->paginate(10);
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
            'name' => 'required|min:2|max:20',
            'description' => 'required|min:5|max:100',
            'price' => 'required',
            'type' => 'required',
            'section_id' => 'required|exists:sections,id',
        ];    
    }

    protected function updateRules()
    {
        return [
            'img' => 'nullable',
            'name' => 'nullable|min:2|max:20',
            'description' => 'nullable|min:5|max:100',
            'price' => 'nullable',
            'type' => 'nullable',
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
            $this->name = $product->name;
            $this->type = $product->type;
            $this->section_id = $product->product_id;
            $this->price = $product->price;
            $this->description = $product->description;
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
        $path = $this->img->store('product', 'public');

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
            $path = $this->img->store('product', 'public');
            $product->img = $path;
        }
        
        // Update section name
        $product->name = $validator["name"];

        $product->price = $validator['price'];
        $product->description = $validator['description'];
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
