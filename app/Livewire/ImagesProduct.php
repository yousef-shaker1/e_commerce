<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product_Image;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ImagesProduct extends Component
{
    use WithPagination, WithFileUploads;
    public $id;
    public $image_id;
    public $images = [];
    public $img;



    public function render()
    {
        $imagess = Product_Image::where('product_id', $this->id)->paginate(10);
        return view('livewire.images-product', compact('imagess'));
    }


    public function rules()
    {
        return [
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function saveImages()
    {
        // التحقق من صحة البيانات
        $this->validate();

        // حفظ الصور في قاعدة البيانات
        foreach ($this->images as $image) {
            // تخزين الصورة في المجلد المحدد
            $path = $image->store('product', 'public'); // تخزين الصورة على القرص

            // إضافة السجل إلى قاعدة البيانات
            Product_Image::create([
                'product_id' => $this->id,
                'image' => $path, // تخزين المسار الخاص بالصورة
            ]);
        }

        session()->flash('message', 'Images created successfully.');
        
        $this->dispatch('close-modal');
    }

    public function deleteImage($id){
        $image = Product_Image::find($id);
        if($image){
            $this->image_id = $id;
            $this->img = $image->image;
        }
    }

    public function destroyImage(){
        $image = Product_Image::where('id', $this->image_id)->first();
        if(!empty($image->image) && Storage::disk('public')->exists($image->image)){
            Storage::disk('public')->delete($image->image);
        }
        $image->delete();
        session()->flash('message', 'image deleted Successfully');
        $this->dispatch('close-modal');
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->images = [];
    }
}
