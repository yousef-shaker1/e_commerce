<?php

namespace App\Livewire;

use App\Models\size;
use Livewire\Component;
use App\Models\customer;
use App\Models\Color_Size;
use App\Models\relationsize;
use App\Models\clothesbasket;
use App\Models\Color_Product;
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
        $this->colors = Color_Product::where('product_id', $this->id)->get();
        $Color_Product = Color_Product::where('product_id', $this->id)->get();
        if($Color_Product->isEmpty()){
            $this->check_color = false;
            $this->relationSizes = relationsize::where('product_id', $this->id)->with('size')->get();
        } else {
            $this->check_color = true;
        }
    }

    public function updatedSelectedColor($colorId)
    {
        $this->colorProduct = Color_Product::where('color_id', $colorId)->first();

        if ($this->colorProduct) {
            $colorSizes = Color_Size::where('color_product_id', $this->colorProduct->id)->get();
            $this->sizes = $colorSizes->pluck('size_id');
            $sizeNames = size::whereIn('id', $this->sizes)->get();
            $this->sizes = $sizeNames;
        } else {
            $this->sizes = [];
        }
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
            } else {
                $this->price = null;
            }
        } else {
            $relationSize = relationsize::where('product_id', $this->id)->where('size_id', $sizeId)->first();
            $this->amount = $relationSize->amount;
            $this->price = null;
        }
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
        session()->flash('Add', 'تم اضافة الاوردر الي السلة بنجاح');
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
        session()->flash('Add', 'تم اضافة الاوردر الي السلة بنجاح');
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
