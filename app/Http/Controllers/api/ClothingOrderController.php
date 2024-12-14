<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Models\clothingorder;
use App\Http\Controllers\Controller;
use App\Http\Controllers\api\ApirequestTrait;
use App\Http\Resources\ClothingOrderResponce;

class ClothingOrderController extends Controller
{
    use ApirequestTrait;
    public function index(){
        $orders = ClothingOrderResponce::collection(clothingorder::all());
        return $this->apiResponse($orders, 'ok', 200);
    }

    public function show($id){
        $orders = clothingorder::find($id);
        if(!$orders){
            return $this->apiResponse(null, 'order not found', 404);
        }
        return $this->apiResponse(new ClothingOrderResponce($orders), 'ok', 200);
    }

    public function success($id){
        $order = clothingorder::find($id);
        if(!$order){
            return $this->apiResponse(null, 'order not found', 404);
        }
        $order->update([
            'status' => 'قبول',
        ]);
        return $this->apiResponse(new ClothingOrderResponce($order), 'order success', 200);
    }

    public function rejection($id){
        $order = clothingorder::find($id);
        if(!$order){
            return $this->apiResponse(null, 'order not found', 404);
        }
        $order->update([
            'status' => 'رفض',
        ]);
        return $this->apiResponse(new ClothingOrderResponce($order), 'order rejection', 200);
    }

    public function completed($id){
        $order = clothingorder::find($id);
        if(!$order){
            return $this->apiResponse(null, 'order not found', 404);
        }
        $order->update([
            'status' => 'اتمام',
        ]);
        return $this->apiResponse(new ClothingOrderResponce($order), 'order complated', 200);
    }

    public function delete($id){
        $order = clothingorder::find($id);
        if(!$order){
            return $this->apiResponse(null, 'order not found', 404);
        }
        $order->delete();
        return $this->apiResponse(null, 'order delete successfully', 200);
    }
}
