<?php

namespace App\Http\Controllers\api;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\clothingsection;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
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
            $validated = $request->validate([
                'name' => 'required|min:2|max:10',
                'img' => 'required',
            ]); 
        } catch (ValidationException $e) {
            return $this->apiResponse(null, $e->errors(), 400);
        }
        try {
            if ($request->hasFile('img')) {
                $image = $request->file('img');
                $imageName = Str::random(40) . '.' . $image->getClientOriginalExtension();

                $path = $image->storeAs('colithingsection', $imageName);
                $validated['img'] = 'colithingsection/' . $imageName; // Path to store in the database
            }
        } catch (\Exception $e) {
            return $this->apiResponse(null, 'Image upload failed: ' . $e->getMessage(), 500);
        }

        try {
            $clothingsection = clothingsection::create($validated);
        } catch (\Exception $e) {
            return $this->apiResponse(null, 'clothingsection creation failed', 500);
        }
        return $this->apiResponse(new ClothingSectionResponce($clothingsection), 'section create susseccfully', 201);
    }

    public function update(Request $request, $id){
        try{
            $validated = $request->validate([
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
        $clothingsection = clothingsection::where('id',$id)->first();
        if(!$clothingsection){
            return $this->apiResponse(null, 'clothingsection not found', 404);
        }
        if ($request->hasFile('img')) {
            try {
                // Delete old image if it exists
                if ($clothingsection->img) {
                    Storage::delete('colithingsection/' . basename($clothingsection->img));
                }

                // Store the new image
                $image = $request->file('img');
                $imageName = Str::random(40) . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('colithingsection', $imageName);
                $validated['img'] = 'colithingsection/' . $imageName;
            } catch (\Exception $e) {
                return $this->apiResponse(null, 'Image upload failed: ' . $e->getMessage(), 500);
            }
        } 
        $clothingsection->update($validated);
        return $this->apiResponse(new ClothingSectionResponce($clothingsection), 'section create susseccfully', 200);
    }

    public function delete($id){
        $clothingsection = clothingsection::where('id',$id)->first();
        if(!$clothingsection){
            return $this->apiResponse(null, 'section not found', 404);
        }

        if ($clothingsection->img) {
            // Extract the file name from the path
            $imagePath = parse_url($clothingsection->img, PHP_URL_PATH);
            $imageName = basename($imagePath);
            
            // Delete the image file from storage
            Storage::delete('colithingsection/' . $imageName);
        }

        $clothingsection->delete();
        return $this->apiResponse(null, 'section delete susseccfully', 200);
    }
}
