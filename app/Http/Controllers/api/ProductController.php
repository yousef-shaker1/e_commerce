<?php

namespace App\Http\Controllers\api;

use App\Models\product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResponce;
use App\Http\Controllers\api\ApirequestTrait;

class ProductController extends Controller
{
    use ApirequestTrait;

    public function index(){
        $products = ProductResponce::collection(product::all());
        return $this->apiResponse($products, 'ok', 200);
    }

    public function show($id){
        $product = product::find($id);
        if(!$product){
            return $this->apiResponse(null, 'product not found', 404);
        }
        return $this->apiResponse(new ProductResponce($product), 'ok', 200);
    }

    public function store(Request $request){
        try{
            $valiate = $request->validate([
                'name' => 'required|min:2|max:10',
                'img' => 'required',
                'description' => 'required|max:100',
                'price' => 'required|numeric',
                'amount' => 'required',
                'section_id' => 'required',
            ]);
        } catch (ValidationException $e) {
            return $this->apiResponse(null, $e->errors(), 400);
        }
        $product = product::create($valiate);
        if (!$product) {
            return $this->apiResponse(null, 'Product not created', 500);
        }
        return $this->apiResponse(new ProductResponce($product), 'product create susseccfully', 201);
    }

    public function update(Request $request, $id){
        try{
            $valiate = $request->validate([
                'name' => 'nullable|min:2|max:10',
                'img' => 'nullable',
                'description' => 'nullable|max:100',
                'price' => 'nullable|numeric',
                'amount' => 'nullable',
                'section_id' => 'nullable',
            ]);
        } catch (ValidationException $e) {
            return $this->apiResponse(null, $e->errors(), 400);
        }
        $product = product::where('id',$id)->first();
        if(!$product){
            return $this->apiResponse(null, 'product not found', 404);
        }

        $product->update($valiate);
        return $this->apiResponse(new ProductResponce($product), 'product create susseccfully', 200);
    }

    public function delete($id){
        $product = product::where('id',$id)->first();
        if(!$product){
            return $this->apiResponse(null, 'product not found', 404);
        }
        $product->delete();
        return $this->apiResponse(null, 'product delete susseccfully', 200);
    }
}
