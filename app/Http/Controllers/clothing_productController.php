<?php

namespace App\Http\Controllers;

use App\Models\size;
use App\Models\relationsize;
use Illuminate\Http\Request;
use App\Models\clothingproduct;
use App\Models\Product_Image;
use App\Http\Requests\check_addsize;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\checkclothingproduct;
use App\Http\Requests\updateclothingproduct;

class clothing_productController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:منتجات الملابس', ['only' => ['index']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.clothingproduct');
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
        //
    }


    public function show_size_product($id)
    {
        return view('admin.show_single_size', compact('id'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(checkclothingproduct $request)
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
    public function update(updateclothingproduct $request, string $id)
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

    public function addsize(check_addsize $request, string $id)
    {
        //
    }

    public function show_images_product($id){
            $images = Product_Image::where('product_id', $id)->get();
            return view('admin.images_product', compact('id', 'images'));
    }
}
