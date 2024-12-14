<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\section;
use Illuminate\Http\Request;
use App\Http\Requests\checkproduct;
use App\Http\Requests\updateproduct;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    function __construct()
    {
    $this->middleware('permission:المنتجات', ['only' => ['index']]);
    $this->middleware('permission:اضافة منتج', ['only' => ['create','store']]);
    $this->middleware('permission:تعديل المنتج', ['only' => ['edit','update']]);
    $this->middleware('permission:حذف المنتج', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = product::paginate(10);
        $sections = section::all();
        return view('admin.product', compact('products', 'sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(checkproduct $request)
    {
        $data = $request->validated();
        $data['img'] = $request->file('img')->store('product', 'public');
        product::create($data);
        session()->flash('success', 'تم اضافة منتج جديد بنجاح');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateproduct $request, string $id)
    {
        $product = product::findorfail($request->id);
        $data = $request->validated();
            if($request->hasFile('img')){
                if (!empty($product->img) && Storage::disk('public')->exists($product->img)) {
                    Storage::disk('public')->delete($product->img);
                }
                $data['img'] = $request->file('img')->store('product', 'public');
            }else{
                unset($data['img']);
            }
        $product->update($data);
        session()->flash('success', 'تم تعديل المنتج بنجاح');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $product = product::findOrFail($request->id);
    
        if (!empty($product->img) && Storage::disk('public')->exists($product->img)) {
            Storage::disk('public')->delete($product->img);
        }
    
        $product->delete();
        
        session()->flash('delete', 'تم حذف المنتج بنجاح');
        return redirect()->back();
    }
}
