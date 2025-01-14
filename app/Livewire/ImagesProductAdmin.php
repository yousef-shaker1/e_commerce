<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Product_Image_Admin;
use Illuminate\Support\Facades\Storage;

class ImagesProductAdmin extends Component
{
    use WithPagination, WithFileUploads;
    public $id;
    public $image_id;
    public $images = [];
    public $img;



    public function render()
    {
        $imagess = Product_Image_Admin::where('product_id', $this->id)->paginate(10);
        return view('livewire.images-product-admin', compact('imagess'));
    }


    public function rules()
    {
        return [
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ];
    }

    public function saveImages()
    {
        // التحقق من صحة البيانات
        $this->validate();

        // حفظ الصور في قاعدة البيانات
        foreach ($this->images as $image) {
            // تخزين الصورة في المجلد المحدد
            $path = $image->store('clothingproduct', 'public'); // تخزين الصورة على القرص

            // إضافة السجل إلى قاعدة البيانات
            Product_Image_Admin::create([
                'product_id' => $this->id,
                'image' => $path, // تخزين المسار الخاص بالصورة
            ]);
        }

        session()->flash('message', 'Images created successfully.');
        
        $this->dispatch('close-modal');
    }

    public function deleteImage($id){
        $image = Product_Image_Admin::find($id);
        if($image){
            $this->image_id = $id;
            $this->img = $image->image;
        }
    }

    public function destroyImage(){
        $image = Product_Image_Admin::where('id', $this->image_id)->first();
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
