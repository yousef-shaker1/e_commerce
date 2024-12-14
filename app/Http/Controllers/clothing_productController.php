<?php

namespace App\Http\Controllers;

use App\Models\size;
use App\Models\relationsize;
use Illuminate\Http\Request;
use App\Models\clothingproduct;
use App\Models\clothingsection;
use App\Http\Requests\check_addsize;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\checkclothingproduct;
use App\Http\Requests\updateclothingproduct;

class clothing_productController extends Controller
{
    function __construct()
    {
    $this->middleware('permission:منتجات الملابس', ['only' => ['index']]);
    $this->middleware('permission:اضافة قسم الملابس', ['only' => ['create','store']]);
    $this->middleware('permission:تعديل قسم الملابس', ['only' => ['edit','update']]);
    $this->middleware('permission:حذف قسم الملابس', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = clothingproduct::paginate(10);
        $sections = clothingsection::all();
        return view('admin.clothingproduct', compact('products', 'sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function show_size()
    {
        
        return view('admin.all_size');
    }

    public function add_size(Request $request)
    {
        $request->validate([
            'size' => 'required|max:30',
        ]);
        size::create([
            'size' => $request->size,
        ]);
        session()->flash('Add', 'تم اضافة المقاس بنجاح');
        return redirect()->back();
    }

    public function deletesize(Request $request, $id)
    {
        size::where('id', $request->id)->delete();
        session()->flash('delete', 'تم حذف المقاس بنجاح');
        return redirect()->back();
    }
    
    public function show_size_product ($id) 
    {
        $relationsizes = relationsize::where('product_id', $id)->get();
        $sizes = size::get();
        $product = $id;
    return view('admin.show_single_size', compact('relationsizes', 'sizes', 'product'));
    }
    
    public function add_single_size(Request $request, $id)
    {
        $request->validate([
        'size' => 'required',
        'amount' => 'required|max:30',
        ]);
        relationsize::create([
            'product_id' => $id,
            'size_id' => $request->size,
            'amount' => $request->amount,
        ]);
            
        session()->flash('Add', 'تم اضافة المقاس بنجاح');
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(checkclothingproduct $request)
    {
        $data = $request->validated();
        $data['img'] = $request->file('img')->store('clothingproduct','public');
        clothingproduct::create($data);  
        session()->flash('Add', 'تم اضافة المنتج بنجاح');
        return redirect()->back(); 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateclothingproduct $request, string $id)
    {
        $clothingproduct = clothingproduct::findorfail($request->id);
        $data = $request->validated();
        if(auth()->user()->roles_name !== ["user"]){
            if($request->hasFile('img')){
                if (!empty($clothingproduct->img) && Storage::disk('public')->exists($clothingproduct->img)) {
                    Storage::disk('public')->delete($clothingproduct->img);
                }
                $data['img'] = $request->file('img')->store('clothingproduct', 'public');
            }else{
                unset($data['img']);
            }
            $clothingproduct->update($data);

        }
        session()->flash('edit', 'تم تعديل المنتج بنجاح');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $clothingproduct = clothingproduct::findorfail($request->id);
        if(!empty($clothingproduct->img && Storage::disk('public')->exists($clothingproduct->img))){
            Storage::disk('public')->delete($clothingproduct->img);
        }
        $clothingproduct->delete();
        session()->flash('delete', 'تم حذف المنتج بنجاح');
        return redirect()->back(); 
        }
        
        public function addsize(check_addsize $request,string $id)
        {
            $product = clothingproduct::findorfail($request->id);
            // $data['img'] = $request->file('img')->store('clothingproduct', 'public');
            clothingproduct::create([
                'name' => $product->name,
                'img' => $product->img,
                'description' => $product->description,
                'type' => $product->type,
                'price' => $request->price,
                'section_id' => $product->section_id,
                ]);
                
            session()->flash('edit', 'تم اضافة المقاس بنجاح');
            return redirect()->back(); 
        }
}
                