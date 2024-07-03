<?php

namespace App\Http\Controllers\api;

use App\Models\message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\api\ApirequestTrait;
use App\Http\Resources\CommentCustomerResponce;

class CommentCustomerController extends Controller
{
    use ApirequestTrait;

    public function index(){
        $messages = CommentCustomerResponce::collection(message::all());
        return $this->apiResponse($messages, 'ok', 200);
    }

    public function show($id){
        $message = message::find($id);
        if(!$message){
            return $this->apiResponse(null, 'message not found', 404);
        }
        return $this->apiResponse(new CommentCustomerResponce($message), 'ok', 200);
    }

    public function delete($id){
        $message = message::find($id);
        if(!$message){
            return $this->apiResponse(null, 'message not found', 404);
        }
        return $this->apiResponse(null, 'message delete susseccfully', 200);
    }
}
