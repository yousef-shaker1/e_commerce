<?php

namespace App\Http\Controllers\api;

use App\Models\basket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Nette\Schema\ValidationException;
use App\Http\Resources\BasketResponce;
use App\Http\Controllers\api\ApirequestTrait;

class BasketController extends Controller
{
    use ApirequestTrait;

    public function index(){
        $baskets = BasketResponce::collection(basket::all());
        return $this->apiResponse($baskets, 'ok', 200);
    }

    public function show($id){
        $basket = BasketResponce::collection(basket::where('customer_id', $id)->get());
        if ($basket->isEmpty()) {
            return $this->apiResponse(null, 'customer_id not found product', 404);
        }
        return $this->apiResponse($basket, 'ok', 200);
    }

    public function store(Request $request){
        try{
            $valiate = $request->validate([
                'customer_id' => 'required',
                'product_id' => 'required',
            ]);
        } catch (ValidationException $e) {
            return $this->apiResponse(null, $e->errors(), 400);
        }
        $basket = basket::create($valiate);
        return $this->apiResponse(new BasketResponce($basket), 'basket create susseccfully', 201);
    }

    public function delete($id){
        $baskets = basket::where('product_id',$id)->get();
        if(!$baskets){
            return $this->apiResponse(null, 'product not found', 404);
        }
        foreach ($baskets as $basket) {
            $basket->delete();
        }
        return $this->apiResponse(null, 'basket delete susseccfully', 200);
    }
}
