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
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.section');
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
    
    
    /**
     * Remove the specified resource from storage.
     */

    
}
            