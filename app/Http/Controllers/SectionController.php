<?php

namespace App\Http\Controllers;

use App\Models\section;
use Illuminate\Http\Request;
use App\Http\Requests\checksection;
use App\Http\Requests\updatesetion;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class SectionController extends Controller
{
    function __construct()
    {
    $this->middleware('permission:اقسام المنتجات', ['only' => ['index']]);
    $this->middleware('permission:اضافة قسم', ['only' => ['create','store']]);
    $this->middleware('permission:تعديل القسم', ['only' => ['show']]);
    $this->middleware('permission:تعديل المستخدم', ['only' => ['edit','update']]);
    $this->middleware('permission:حذف القسم', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = section::paginate(5);
        return view('admin.section',compact('sections'));
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
    public function store(checksection $request)
    {
        $data = $request->validated();
        $data['img'] = $request->file('img')->store('section', 'public');
        section::create($data);
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
        public function update(updatesetion $request, string $id)
        {
            $section = section::findorfail($request->id);
            $data = $request->validated();
            if(auth()->user()->roles_name !== ["user"]){

                if($request->hasFile('img')){
                    if (!empty($section->img) && Storage::disk('public')->exists($section->img)) {
                        Storage::disk('public')->delete($section->img);
                    }
                    $data['img'] = $request->file('img')->store('section', 'public');
                }else{
                    unset($data['img']);
                }
            $section->update($data);
            }
            
            session()->flash('edit', 'تم تعديل القسم بنجاح');
            return redirect()->back();
        }
    
    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Request $request)
    {
        $section = Section::findOrFail($request->id);
    
        if (!empty($section->img) && Storage::disk('public')->exists($section->img)) {
            Storage::disk('public')->delete($section->img);
        }
    
        $section->delete();
        
        session()->flash('delete', 'تم حذف القسم بنجاح');
        return redirect()->back();
    }
}
            