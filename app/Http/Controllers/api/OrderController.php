<?php

namespace App\Http\Controllers\api;

use App\Models\order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResponce;
use App\Http\Controllers\api\ApirequestTrait;

class OrderController extends Controller
{
    use ApirequestTrait;
    public function index(){
        $orders = OrderResponce::collection(order::all());
        return $this->apiResponse($orders, 'ok', 200);
    }

    public function show($id){
        $orders = order::find($id);
        if(!$orders){
            return $this->apiResponse(null, 'order not found', 404);
        }
        return $this->apiResponse(new OrderResponce($orders), 'ok', 200);
    }

    public function success($id){
        $order = order::find($id);
        if(!$order){
            return $this->apiResponse(null, 'order not found', 404);
        }
        $order->update([
            'status' => 'قبول',
        ]);
        return $this->apiResponse(new OrderResponce($order), 'order success', 200);
    }

    public function rejection($id){
        $order = order::find($id);
        if(!$order){
            return $this->apiResponse(null, 'order not found', 404);
        }
        $order->update([
            'status' => 'رفض',
        ]);
        return $this->apiResponse(new OrderResponce($order), 'order rejection', 200);
    }

    public function completed($id){
        $order = order::find($id);
        if(!$order){
            return $this->apiResponse(null, 'order not found', 404);
        }
        $order->update([
            'status' => 'اتمام',
        ]);
        return $this->apiResponse(new OrderResponce($order), 'order complated', 200);
    }

    public function delete($id){
        $order = order::find($id);
        if(!$order){
            return $this->apiResponse(null, 'order not found', 404);
        }
        $order->delete();
        return $this->apiResponse(null, 'order delete successfully', 200);
    }
}
