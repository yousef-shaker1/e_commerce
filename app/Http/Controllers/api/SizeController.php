<?php

namespace App\Http\Controllers\api;

use App\Models\size;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SizeResponce;
use Illuminate\Validation\ValidationException;

class SizeController extends Controller
{
    use ApirequestTrait;

    public function index(){
        $sizes = SizeResponce::collection(size::all());
        return $this->apiResponse($sizes, 'ok', 200);
    }

    public function show($id){
        $size = size::find($id);
        if(!$size){
            return $this->apiResponse(null, 'size not found', 404);
        }
        return $this->apiResponse(new SizeResponce($size), 'ok', 200);
    }

    public function store(Request $request){
        try{
            $valiate = $request->validate([
                'size' => 'required',
            ]);
        } catch (ValidationException $e) {
            return $this->apiResponse(null, $e->errors(), 400);
        }
        $size = size::create($valiate);
        return $this->apiResponse(new SizeResponce($size), 'size create susseccfully', 201);
    }

    public function update(Request $request, $id){
        try{
            $valiate = $request->validate([
                'size' => 'required',
            ]);
        } catch (ValidationException $e) {
            return $this->apiResponse(null, $e->errors(), 400);
        }
        $size = size::where('id',$id)->first();
        if(!$size){
            return $this->apiResponse(null, 'size not found', 404);
        }

        $size->update($valiate);
        return $this->apiResponse(new SizeResponce($size), 'size create susseccfully', 200);
    }

    public function delete($id){
        $size = size::where('id',$id)->first();
        if(!$size){
            return $this->apiResponse(null, 'size not found', 404);
        }
        $size->delete();
        return $this->apiResponse(null, 'size delete susseccfully', 200);
    }
}
