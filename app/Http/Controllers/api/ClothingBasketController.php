<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Models\clothesbasket;
use App\Http\Controllers\Controller;
use App\Http\Controllers\api\ApirequestTrait;
use App\Http\Resources\ClothingBasketResponce;
use Illuminate\Validation\ValidationException;

class ClothingBasketController extends Controller
{
    use ApirequestTrait;

    public function index(){
        $baskets = ClothingBasketResponce::collection(clothesbasket::all());
        return $this->apiResponse($baskets, 'ok', 200);
    }

    public function show($id){
        $basket = ClothingBasketResponce::collection(clothesbasket::where('customer_id', $id)->get());
        if ($basket->isEmpty()) {
            return $this->apiResponse(null, 'customer_id not found product', 404);
        }
        return $this->apiResponse($basket, 'ok', 200);
    }

    public function store(Request $request){
        try{
            $valiate = $request->validate([
                'customer_id' => 'required|numeric',
                'product_id' => 'required|numeric',
                'size_id' => 'required|numeric',
            ]);
        } catch (ValidationException $e) {
            return $this->apiResponse(null, $e->errors(), 400);
        }
        $basket = clothesbasket::create($valiate);
        return $this->apiResponse(new ClothingBasketResponce($basket), 'basket create susseccfully', 201);
    }

    public function delete($id){
        $baskets = clothesbasket::where('product_id',$id)->get();
        if(!$baskets){
            return $this->apiResponse(null, 'product not found', 404);
        }
        foreach ($baskets as $basket) {
            $basket->delete();
        }
        return $this->apiResponse(null, 'basket delete susseccfully', 200);
    }
}
