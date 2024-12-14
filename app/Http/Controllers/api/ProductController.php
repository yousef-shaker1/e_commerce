<?php

namespace App\Http\Controllers\api;

use App\Models\product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResponce;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\api\ApirequestTrait;
use League\Config\Exception\ValidationException;

class ProductController extends Controller
{
    use ApirequestTrait;

    public function index(){
        $products = ProductResponce::collection(product::all());
        return $this->apiResponse($products, 'ok', 200);
    }

    public function show($id){
        $product = product::find($id);
        if(!$product){
            return $this->apiResponse(null, 'product not found', 404);
        }
        return $this->apiResponse(new ProductResponce($product), 'ok', 200);
    }

    public function store(Request $request){
        try{
            $validated = $request->validate([
                'name' => 'required|min:2|max:10',
                'img' => 'required',
                'description' => 'required|max:100',
                'price' => 'required|numeric',
                'amount' => 'required',
                'section_id' => 'required',
            ]);
        } catch (ValidationException $e) {
            return $this->apiResponse(null, $e->errors(), 400);
        }

        try {
            if ($request->hasFile('img')) {
                $image = $request->file('img');
                $imageName = Str::random(40) . '.' . $image->getClientOriginalExtension();

                $path = $image->storeAs('product', $imageName);
                $validated['img'] = 'product/' . $imageName; // Path to store in the database
            }
        } catch (\Exception $e) {
            return $this->apiResponse(null, 'Image upload failed: ' . $e->getMessage(), 500);
        }

        try {
            $product = product::create($validated);
        } catch (\Exception $e) {
            return $this->apiResponse(null, 'product creation failed', 500);
        }
        return $this->apiResponse(new ProductResponce($product), 'product create susseccfully', 201);
    }

    public function update(Request $request, $id){
        try{
            $validated = $request->validate([
                'name' => 'nullable|min:2|max:10',
                'img' => 'nullable',
                'description' => 'nullable|max:100',
                'price' => 'nullable|numeric',
                'amount' => 'nullable',
                'section_id' => 'nullable',
            ]);
        } catch (ValidationException $e) {
            return $this->apiResponse(null, $e->errors(), 400);
        }
        $product = product::where('id',$id)->first();
        if(!$product){
            return $this->apiResponse(null, 'product not found', 404);
        }

        if ($request->hasFile('img')) {
            try {
                // Delete old image if it exists
                if ($product->img) {
                    Storage::delete('product/' . basename($product->img));
                }

                // Store the new image
                $image = $request->file('img');
                $imageName = Str::random(40) . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('product', $imageName);
                $validated['img'] = 'product/' . $imageName;
            } catch (\Exception $e) {
                return $this->apiResponse(null, 'Image upload failed: ' . $e->getMessage(), 500);
            }
        } 

        $product->update($validated);
        return $this->apiResponse(new ProductResponce($product), 'product create susseccfully', 200);
    }

    public function delete($id){
        $product = product::where('id',$id)->first();
        if(!$product){
            return $this->apiResponse(null, 'product not found', 404);
        }
        if ($product->img) {
            // Extract the file name from the path
            $imagePath = parse_url($product->img, PHP_URL_PATH);
            $imageName = basename($imagePath);
            
            // Delete the image file from storage
            Storage::delete('product/' . $imageName);
        }
        $product->delete();
        return $this->apiResponse(null, 'product delete susseccfully', 200);
    }
}
