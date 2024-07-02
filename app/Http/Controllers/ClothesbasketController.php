<?php

namespace App\Http\Controllers;

use App\Models\customer;
use Illuminate\Http\Request;
use App\Models\clothesbasket;
use App\Models\clothingproduct;
use Illuminate\Support\Facades\Auth;

class ClothesbasketController extends Controller
{
    public function add_clothing_basket($id1, $id2){
        $customer = customer::where('email', Auth::user()->email)->first();
        clothesbasket::create([
            'customer_id' => $customer->id,
            'product_id' => $id2,
            'size_id' => $id1,
        ]);
        session()->flash('Add', 'تم اضافة الاوردر الي السلة بنجاح');
        return redirect()->back();
    }
}
