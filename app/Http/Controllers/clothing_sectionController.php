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
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.colthing_section');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
    }
}
