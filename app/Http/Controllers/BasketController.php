<?php

namespace App\Http\Controllers;

use App\Models\size;
use App\Models\basket;
use App\Models\product;
use App\Models\customer;
use App\Models\relationsize;
use Illuminate\Http\Request;
use App\Models\clothesbasket;
use App\Models\clothingproduct;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function add_basket($id){
        $customer = customer::where('email' , Auth::user()->email)->first();
        basket::create([
            'customer_id' => $customer->id,
            'product_id' => $id,
        ]);
        session()->flash('Add', 'تم اضافة الاوردر الي السلة بنجاح');
        return redirect()->back();
    }
    
    public function show_basket(){
        $customer = customer::where('email' , Auth::user()->email)->first();
        $baskets = basket::where('customer_id', $customer->id)->get();
        $clothesbaskets = clothesbasket::where('customer_id', $customer->id)->get();
        return view('user_page.show_basket', compact('baskets', 'clothesbaskets'));
    }
    
    public function show_single_basket($id){
        $product = product::where('id', $id)->first();
        return view('user_page.show_single_basket', compact('product'));
    }


    public function show_single_clohing_basket($id){
        $clothingproduct = clothingproduct::where('id', $id)->first();
        $size_id = relationsize::where('product_id', $clothingproduct->id)->first();
        $customer = customer::where('email' , Auth::user()->email)->first();
        $sizes = clothesbasket::where('customer_id', Auth::user()->id)->where('product_id', $id)->first();
        $size = size::where('id',$sizes->size_id)->first();
        return view('user_page.show_single_clohing_basket', compact('clothingproduct', 'size'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function del_clothing_basket($id)
    {
        $customer = customer::where('email', Auth::user()->email)->first();
        $ee = clothesbasket::where('customer_id', $customer->id)->where('product_id', $id)->delete();
        return redirect()->back();
    }

    public function del_product_basket($id)
    {
        $customer = customer::where('email', Auth::user()->email)->first();
        $ee = basket::where('customer_id', $customer->id)->where('product_id', $id)->delete();
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(basket $basket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(basket $basket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, basket $basket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(basket $basket)
    {
        //
    }
}
