<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Models\clothingsection;
use App\Http\Controllers\Controller;
use App\Http\Controllers\api\ApirequestTrait;
use Illuminate\Validation\ValidationException;
use App\Http\Resources\ClothingSectionResponce;

class ClothingSectionController extends Controller
{
    use ApirequestTrait;

    public function index(){
        $clothingsection = ClothingSectionResponce::collection(clothingsection::all());
        return $this->apiResponse($clothingsection, 'ok', 200);
    }

    public function show($id){
        $clothingsection = clothingsection::find($id);
        if(!$clothingsection){
            return $this->apiResponse(null, 'section not found', 404);
        }
        return $this->apiResponse(new ClothingSectionResponce($clothingsection), 'ok', 200);
    }

    public function store(Request $request){
        try{
            $valiate = $request->validate([
                'name' => 'required|min:2|max:10',
                'img' => 'required',
            ]);
        } catch (ValidationException $e) {
            return $this->apiResponse(null, $e->errors(), 400);
        }
        $clothingsection = clothingsection::create($valiate);
        return $this->apiResponse(new ClothingSectionResponce($clothingsection), 'section create susseccfully', 201);
    }

    public function update(Request $request, $id){
        try{
            $valiate = $request->validate([
                'name' => 'nullable',
                'img' => 'nullable',
            ]);
        } catch (ValidationException $e) {
            return $this->apiResponse(null, $e->errors(), 400);
        }
        $clothingsection = clothingsection::where('id',$id)->first();
        if(!$clothingsection){
            return $this->apiResponse(null, 'section not found', 404);
        }

        $clothingsection->update($valiate);
        return $this->apiResponse(new ClothingSectionResponce($clothingsection), 'section create susseccfully', 200);
    }

    public function delete($id){
        $clothingsection = clothingsection::where('id',$id)->first();
        if(!$clothingsection){
            return $this->apiResponse(null, 'section not found', 404);
        }
        $clothingsection->delete();
        return $this->apiResponse(null, 'section delete susseccfully', 200);
    }
}
