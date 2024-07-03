<?php

namespace App\Http\Controllers\api;

use App\Models\relationsize;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RelationSizeResponce;

class RelationSizeController extends Controller
{
    use ApirequestTrait;

    public function index(){
        $relationsize = RelationSizeResponce::collection(relationsize::all());
        return $this->apiResponse($relationsize, 'ok', 200);
    }

    public function show($id){
        $relationsize = RelationSizeResponce::collection(relationsize::where('product_id', $id)->get());
        if (!$relationsize){
            return $this->apiResponse(null, 'relationsize not found', 404);
        }
        return $this->apiResponse($relationsize, 'ok', 200);
    }

    public function store(Request $request){
        try{
            $valiate = $request->validate([
                'product_id' => 'required|numeric',
                'size_id' => 'required|numeric',
                'amount' => 'required|numeric',
            ]);
        } catch (ValidationException $e) {
            return $this->apiResponse(null, $e->errors(), 400);
        }
        $relationsize = relationsize::create($valiate);
        return $this->apiResponse(new RelationSizeResponce($relationsize), 'relationsize create susseccfully', 201);
    }

    public function delete($id){
        $relationsize = relationsize::where('product_id', $id)->get();
        if(!$relationsize){
            return $this->apiResponse(null, 'product_id not found', 404);
        }
        foreach ($relationsize as $size) {
            $size->delete();
        }
        return $this->apiResponse(null, 'relationsize delete successfully', 200);
    }
}
