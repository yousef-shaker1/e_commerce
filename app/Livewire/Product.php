<?php

namespace App\Livewire;

use App\Models\product as ModelsProduct;
use App\Models\section;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Product extends Component
{
    use WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $id;
    public $name = [
        'ar' => '',
        'en' => ''
    ];
    public $description = [
        'ar' => '',
        'en' => ''
    ];
    public $img;
    public $price;
    public $amount;
    public $search;
    public $section_id;
    
    public function render()
    {
        $products = ModelsProduct::with('section')
        ->where(function ($query) {
            $query->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(name, '$.ar')) LIKE ?", ["%{$this->search}%"])
                ->orWhereRaw("JSON_UNQUOTE(JSON_EXTRACT(name, '$.en')) LIKE ?", ["%{$this->search}%"])
                ->orWhereRaw("JSON_UNQUOTE(JSON_EXTRACT(description, '$.ar')) LIKE ?", ["%{$this->search}%"])
                ->orWhereRaw("JSON_UNQUOTE(JSON_EXTRACT(description, '$.en')) LIKE ?", ["%{$this->search}%"]);
        })
        ->paginate(10);
        $sections = section::all();
        return view('livewire.product', compact('products', 'sections'));
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function rules()
    {
        return [
            'img' => 'required|image',
            'name.*' => 'required|min:2|max:50',
            'description.*' => 'required|min:5|max:100',
            'price' => 'required',
            'amount' => 'required',
            'section_id' => 'required|exists:sections,id',
        ];    
    }

    protected function updateRules()
    {
        return [
            'img' => 'nullable',
            'name.*' => 'nullable|min:2|max:50',
            'description.*' => 'nullable|min:5|max:100',
            'price' => 'nullable',
            'amount' => 'nullable',
            'section_id' => 'nullable',
        ];
    }

    public function updated($fields)
    {
        return $this->validateOnly($fields);
    }

    public function editProduct(int $id)
    {
        $product = ModelsProduct::find($id);
        if($product){
            $this->id = $product->id;
            $this->img = $product->img;
            $this->name =  $product->getTranslations('name');
            $this->amount = $product->amount;
            $this->section_id = $product->product_id;
            $this->price = $product->price;
            $this->description =  $product->getTranslations('description');
        } else {
            return redirect()->back();
        }
    }

    public function deleteProduct(int $id)
    {
        $product = ModelsProduct::find($id);
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

        ModelsProduct::create([
            'img' => $path,
            'name' => $validateData['name'],
            'price' => $validateData['price'],
            'amount' => $validateData['amount'],
            'description' => $validateData['description'],
            'section_id' => $validateData['section_id'],
        ]);
        session()->flash('success', 'product created Successfully');
        $this->dispatch('close-modal');
    }

    public function updateProduct()
    {
        $validator = $this->validate($this->updateRules());
        $product = ModelsProduct::find($this->id);
        // Check if a new image is provided
        if ($this->img && !$this->img instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile === false) {
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
        $product->amount = $validator['amount'];
        $product->description = $validator['description'];
        $product->section_id = $validator['section_id'] ?? $product->section_id;
        $product->save();
    
        session()->flash('success', 'product updated Successfully');
        $this->dispatch('close-modal');
    }

    public function destroyProduct(){
        $product = ModelsProduct::find($this->id);
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
        $this->amount = '';
        $this->section_id = '';
        $this->description = '';
        $this->price = '';
    }
}
