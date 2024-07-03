<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Models\clothingproduct;
use App\Http\Controllers\Controller;
use App\Http\Controllers\api\ApirequestTrait;
use Illuminate\Validation\ValidationException;
use App\Http\Resources\ClothingProductResponce;

class ClothingProductController extends Controller
{
    use ApirequestTrait;

    public function index(){
        $clothingproducts = ClothingProductResponce::collection(clothingproduct::all());
        return $this->apiResponse($clothingproducts, 'ok', 200);
    }

    public function show($id){
        $clothingproduct = clothingproduct::find($id);
        if(!$clothingproduct){
            return $this->apiResponse(null, 'product not found', 404);
        }
        return $this->apiResponse(new ClothingProductResponce($clothingproduct), 'ok', 200);
    }

    public function store(Request $request){
        try{
            $valiate = $request->validate([
                'name' => 'required|min:2|max:10',
                'img' => 'required',
                'description' => 'required|max:100',
                'price' => 'required|numeric',
                'type' => 'required',
                'section_id' => 'required',
            ]);
        } catch (ValidationException $e) {
            return $this->apiResponse(null, $e->errors(), 400);
        }
        $clothingproduct = clothingproduct::create($valiate);
        if (!$clothingproduct) {
            return $this->apiResponse(null, 'Product not created', 500);
        }
        return $this->apiResponse(new ClothingProductResponce($clothingproduct), 'product create susseccfully', 201);
    }

    public function update(Request $request, $id){
        try{
            $valiate = $request->validate([
                'name' => 'nullable|min:2|max:10',
                'img' => 'nullable',
                'description' => 'nullable|max:100',
                'price' => 'nullable|numeric',
                'type' => 'nullable',
                'section_id' => 'nullable',
            ]);
        } catch (ValidationException $e) {
            return $this->apiResponse(null, $e->errors(), 400);
        }
        $clothingproduct = clothingproduct::where('id',$id)->first();
        if(!$clothingproduct){
            return $this->apiResponse(null, 'product not found', 404);
        }

        $clothingproduct->update($valiate);
        return $this->apiResponse(new ClothingProductResponce($clothingproduct), 'product create susseccfully', 200);
    }

    public function delete($id){
        $clothingproduct = clothingproduct::where('id',$id)->first();
        if(!$clothingproduct){
            return $this->apiResponse(null, 'product not found', 404);
        }
        $clothingproduct->delete();
        return $this->apiResponse(null, 'product delete susseccfully', 200);
    }
}
