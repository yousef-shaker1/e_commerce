<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\clothingsection;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\checkclothingsection;
use App\Http\Requests\updateclothingsection;

class clothing_sectionController extends Controller
{
    function __construct()
    {
    $this->middleware('permission:اقسام منتجات الملابس', ['only' => ['index']]);
    $this->middleware('permission:اضافة قسم الملابس', ['only' => ['create','store']]);
    $this->middleware('permission:تعديل قسم الملابس', ['only' => ['edit','update']]);
    $this->middleware('permission:حذف قسم الملابس', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = clothingsection::all();
        return view('admin.colthing_section', compact('sections'));
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
    public function store(checkclothingsection $request)
    {
        $data = $request->validated();
        $data['img'] = $request->file('img')->store('colithingsection', 'public');
        clothingsection::create($data);
        session()->flash('Add', 'تم اضافة القسم بنجاح');
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
    public function update(updateclothingsection $request, string $id)
    {
        $clothingsection = clothingsection::findorfail($request->id);
            $data = $request->validated();
            
                if($request->hasFile('img')){
                    if (!empty($clothingsection->img) && Storage::disk('public')->exists($clothingsection->img)) {
                        Storage::disk('public')->delete($clothingsection->img);
                    }
                    $data['img'] = $request->file('img')->store('colithingsection', 'public');
                }else{
                    unset($data['img']);
                }
            $clothingsection->update($data);
            
            session()->flash('edit', 'تم تعديل القسم بنجاح');
            return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $clothingsection = clothingsection::findOrFail($request->id);
    
        if (!empty($clothingsection->img) && Storage::disk('public')->exists($clothingsection->img)) {
            Storage::disk('public')->delete($clothingsection->img);
        }
        $clothingsection->delete();
        
        session()->flash('delete', 'تم حذف القسم بنجاح');
        return redirect()->back();
    }
}
