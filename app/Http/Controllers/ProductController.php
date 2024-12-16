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
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.product');
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
        //
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
