<?php

namespace App\Http\Controllers\api;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\clothingproduct;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
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
            $validated = $request->validate([
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
        try {
            if ($request->hasFile('img')) {
                $image = $request->file('img');
                $imageName = Str::random(40) . '.' . $image->getClientOriginalExtension();

                $path = $image->storeAs('clothingproduct', $imageName);
                $validated['img'] = 'clothingproduct/' . $imageName; // Path to store in the database
            }
        } catch (\Exception $e) {
            return $this->apiResponse(null, 'Image upload failed: ' . $e->getMessage(), 500);
        }

        try {
            $clothingproduct = clothingproduct::create($validated);
        } catch (\Exception $e) {
            return $this->apiResponse(null, 'clothingproduct creation failed', 500);
        }
        return $this->apiResponse(new ClothingProductResponce($clothingproduct), 'product create susseccfully', 201);
    }

    public function update(Request $request, $id){
        try{
            $validated = $request->validate([
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

        if ($request->hasFile('img')) {
            try {
                // Delete old image if it exists
                if ($clothingproduct->img) {
                    Storage::delete('clothingproduct/' . basename($clothingproduct->img));
                }

                // Store the new image
                $image = $request->file('img');
                $imageName = Str::random(40) . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('clothingproduct', $imageName);
                $validated['img'] = 'clothingproduct/' . $imageName;
            } catch (\Exception $e) {
                return $this->apiResponse(null, 'Image upload failed: ' . $e->getMessage(), 500);
            }
        } 

        $clothingproduct->update($validated);
        return $this->apiResponse(new ClothingProductResponce($clothingproduct), 'product create susseccfully', 200);
    }

    public function delete($id){
        $clothingproduct = clothingproduct::where('id',$id)->first();
        if(!$clothingproduct){
            return $this->apiResponse(null, 'product not found', 404);
        }
        if ($clothingproduct->img) {
            // Extract the file name from the path
            $imagePath = parse_url($clothingproduct->img, PHP_URL_PATH);
            $imageName = basename($imagePath);
            
            // Delete the image file from storage
            Storage::delete('clothingproduct/' . $imageName);
        }
        $clothingproduct->delete();
        return $this->apiResponse(null, 'clothingproduct delete susseccfully', 200);
    }
}
