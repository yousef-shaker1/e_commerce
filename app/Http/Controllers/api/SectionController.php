<?php

namespace App\Http\Controllers\api;

use App\Models\section;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SectionResponce;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\api\ApirequestTrait;
use League\Config\Exception\ValidationException;

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

                $path = $image->storeAs('section', $imageName);
                $validated['img'] = 'section/' . $imageName; // Path to store in the database
            }
        } catch (\Exception $e) {
            return $this->apiResponse(null, 'Image upload failed: ' . $e->getMessage(), 500);
        }

        try {
            $section = section::create($validated);
        } catch (\Exception $e) {
            return $this->apiResponse(null, 'section creation failed', 500);
        }
        return $this->apiResponse(new SectionResponce($section), 'section create susseccfully', 201);
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
        $section = section::where('id',$id)->first();
        if(!$section){
            return $this->apiResponse(null, 'section not found', 404);
        }
        if ($request->hasFile('img')) {
            try {
                // Delete old image if it exists
                if ($section->img) {
                    Storage::delete('section/' . basename($section->img));
                }

                // Store the new image
                $image = $request->file('img');
                $imageName = Str::random(40) . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('section', $imageName);
                $validated['img'] = 'section/' . $imageName;
            } catch (\Exception $e) {
                return $this->apiResponse(null, 'Image upload failed: ' . $e->getMessage(), 500);
            }
        } 
        $section->update($validated);
        return $this->apiResponse(new SectionResponce($section), 'section create susseccfully', 200);
    }

    public function delete($id){
        $section = section::where('id',$id)->first();
        if(!$section){
            return $this->apiResponse(null, 'section not found', 404);
        }
        if ($section->img) {
            // Extract the file name from the path
            $imagePath = parse_url($section->img, PHP_URL_PATH);
            $imageName = basename($imagePath);
            
            // Delete the image file from storage
            Storage::delete('section/' . $imageName);
        }
        $section->delete();
        return $this->apiResponse(null, 'section delete susseccfully', 200);
    }
}
