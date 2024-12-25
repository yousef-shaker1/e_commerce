<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index(){
        return view('admin.colors');
    }

    public function show_color_product($id){
        return view('admin.show_single_color', compact('id'));
    }

    public function view_size_and_price($id){
        return view('admin.view_size_and_price', compact('id'));
    }
}
