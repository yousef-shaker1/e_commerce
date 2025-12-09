<?php

namespace App\Livewire;

use App\Models\size;
use Livewire\Component;
use App\Models\customer;
use App\Models\Color_Size;
use App\Models\relationsize;
use App\Models\clothesbasket;
use App\Models\ColorProduct;
use App\Models\clothingproduct;
use App\Trait\Check_Size_And_Amount;
use Illuminate\Support\Facades\Auth;

class ShowSingleClothingProduct extends Component
{
    use Check_Size_And_Amount;
    public $id;
    public $selectedColor = null;
    public $selectedSize = null;
    public $amount;
    public $price = null;
    public $sizes = [];
    public $colorProduct;
    public $colors = [];
    public $check_color;
    public $relationSizes;

    public function mount($id)
    {
        $this->id = $id;
        $this->colors = ColorProduct::where('product_id', $this->id)->get();
        $ColorProduct = ColorProduct::where('product_id', $this->id)->get();
        if($ColorProduct->isEmpty()){
            $this->check_color = false;
            $this->relationSizes = relationsize::where('product_id', $this->id)->with('size')->get();
        } else {
            $this->check_color = true;
        }
    }


    public function updatedSelectedColor($colorId)
    {
        // البحث عن المنتج المرتبط باللون المختار
        $this->colorProduct = ColorProduct::where('color_id', $colorId)->first();
    
        if ($this->colorProduct) {
            // جلب المقاسات المرتبطة باللون المختار
            $colorSizes = Color_Size::where('color_product_id', $this->colorProduct->id)->get();
            $this->sizes = size::whereIn('id', $colorSizes->pluck('size_id'))->get();
        } else {
            // إذا لم يكن هناك منتج مرتبط، إعادة تعيين المقاسات إلى مصفوفة فارغة
            $this->sizes = [];
        }
    
        // إعادة تعيين القيم الأخرى عند تغيير اللون
        $this->selectedSize = null;
        $this->price = null;
        $this->amount = null;
    }
    
    public function updatedSelectedSize($sizeId)
    {
        if ($this->colorProduct) {
            $colorSize = Color_Size::where('color_product_id', $this->colorProduct->id)
                ->where('size_id', $sizeId)
                ->first();
    
            if ($colorSize) {
                $this->price = $colorSize->price;
                $this->amount = $colorSize->amount;
    
                if ($this->amount == 0) {
                    session()->flash('error', __('page.product_out_of_stock') );
                }
            } else {
                $this->resetPriceAndAmount();
            }
        } else {
            $relationSize = relationsize::where('product_id', $this->id)
                ->where('size_id', $sizeId)
                ->first();
    
            if ($relationSize) {
                $this->amount = $relationSize->amount;
            } else {
                $this->amount = 0;
            }
    
            $this->price = null;
        }
    }
    
    // وظيفة لإعادة تعيين السعر والكمية
    private function resetPriceAndAmount()
    {
        $this->price = null;
        $this->amount = null;
    }
    
    //product has color and size
    public function addToBasket(){

        $isValid = $this->checkSizeAndAmount($this->selectedColor,$this->selectedSize, $this->amount);
        if (!$isValid) {
            return; 
        }
        $customer = customer::where('email', Auth::user()->email)->first();
            clothesbasket::create([
                'customer_id' => $customer->id,
                'product_id' => $this->id,
                'color_id' => $this->selectedColor,
                'size_id' => $this->selectedSize,
            ]);
        session()->flash('Add', __('page.order_add_to_cart'));
        return redirect()->back();
    }

    public function OrderNow(){
        $isValid = $this->checkSizeAndAmount($this->selectedColor,$this->selectedSize, $this->amount);
        if (!$isValid) {
            return; 
        }

        $customer = customer::where('email', Auth::user()->email)->first();
            clothesbasket::create([
                'customer_id' => $customer->id,
                'product_id' => $this->id,
                'color_id' => $this->selectedColor,
                'size_id' => $this->selectedSize,
            ]);
            return redirect()->route('show_single_clohing_basket', $this->id);
    }


    //product has no color
    public function add_To_Basket(){
        $isValid = $this->checkSizeAndAmountNoColor($this->selectedSize, $this->amount);
        if (!$isValid) {
            return; 
        }
        
        $customer = customer::where('email', Auth::user()->email)->first();
            clothesbasket::create([
                'customer_id' => $customer->id,
                'product_id' => $this->id,
                'color_id' => $this->selectedColor,
                'size_id' => $this->selectedSize,
            ]);
        session()->flash('Add', __('page.order_add_to_cart'));
        return redirect()->back();
    }

    public function Order_Now(){
        $isValid = $this->checkSizeAndAmountNoColor($this->selectedSize, $this->amount);
        if (!$isValid) {
            return; 
        }
        $customer = customer::where('email', Auth::user()->email)->first();
            clothesbasket::create([
                'customer_id' => $customer->id,
                'product_id' => $this->id,
                'color_id' => $this->selectedColor,
                'size_id' => $this->selectedSize,
            ]);
        return redirect()->route('show_single_clohing_basket', $this->id);
    }

    public function render()
    {
        $product = clothingproduct::where('id', $this->id)->first();
        return view('livewire.show-single-clothing-product', compact('product'));
    }
}
