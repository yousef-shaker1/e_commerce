<?php

namespace App\Http\Controllers\api;

use App\Models\section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SectionResponce;
use App\Http\Controllers\api\ApirequestTrait;

class SectionController extends Controller
{
    use ApirequestTrait;

    public function index(){
        $sections = SectionResponce::collection(section::all());
        return $this->apiResponse($sections, 'ok', 200);
    }

    public function show($id){
        $section = section::find($id);
        if(!$section){
            return $this->apiResponse(null, 'section not found', 404);
        }
        return $this->apiResponse(new SectionResponce($section), 'ok', 200);
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
        $section = section::create($valiate);
        return $this->apiResponse(new SectionResponce($section), 'section create susseccfully', 201);
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
        $section = section::where('id',$id)->first();
        if(!$section){
            return $this->apiResponse(null, 'section not found', 404);
        }

        $section->update($valiate);
        return $this->apiResponse(new SectionResponce($section), 'section create susseccfully', 200);
    }

    public function delete($id){
        $section = section::where('id',$id)->first();
        if(!$section){
            return $this->apiResponse(null, 'section not found', 404);
        }
        $section->delete();
        return $this->apiResponse(null, 'section delete susseccfully', 200);
    }
}
