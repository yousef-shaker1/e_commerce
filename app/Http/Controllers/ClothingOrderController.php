<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use App\Models\size;
use App\Mail\okorder;
use App\Models\order;
use App\Models\customer;
use App\Models\relationsize;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use App\Models\clothesbasket;
use App\Models\clothingorder;
use App\Models\clothingproduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ClothingOrderController extends Controller
{
    function __construct()
    {
    $this->middleware('permission:اوردرات الملابس', ['only' => ['index']]);
    $this->middleware('permission:قبول اوردر الملابس', ['only' => ['status1']]);
    $this->middleware('permission:رفض اوردر الملابس', ['only' => ['status2']]);
    $this->middleware('permission:اتمام اوردر الملابس', ['only' => ['status3']]);
    $this->middleware('permission:حذف اوردر الملابس', ['only' => ['destroy']]);
    }
    public function index()
    {
        $orders =  clothingorder::paginate(10);
        return view('admin.clothing_order',compact('orders'));
    }

    public function send_clothing_order(Request $request, $id)
    {
    $request->validate([
        'date' => 'required',
    ]);
    $clothing_product = clothingproduct::where('id', $id)->first();
    $date = request()->input('date');
    $count = request()->input('count');
    $customer = customer::where('email', Auth::user()->email)->first();
    $basket = clothesbasket::where('product_id', $id)->where('customer_id', $customer->id)->first();
    
    $size_id = $basket->size_id;
    $size = relationsize::where('product_id', $id)->where('size_id', $size_id)->first();
    if ($request->count < $size->amount){
        Stripe::setApiKey(config('services.stripe.secret'));
    
        $session = Session::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Send me money!!',
                        ],
                        'unit_amount' =>$count * $clothing_product->price * 100,
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('success'),
            'cancel_url' => route('cancel'),
        ]);
        
        //Create order:
        clothingorder::create([
            'customer_id' => $customer->id,
            'day' => $date,
            'product_id' => $id,
            'count' => $count,
            'size' => $request->size,
            'status' => 'قبول',
        ]);
        $size->update([
            'amount' => $size->amount - $count,
        ]);
        $productName = $clothing_product->name;
        $address = $customer->address;
        Mail::to(Auth::user()->email)->send(new okorder($productName, $date, $address));

        clothesbasket::where('customer_id', $customer->id)->where('product_id', $id)->delete();

        return redirect()->away($session->url);

    } else {
        session()->flash('error', 'للاسف الكمية غير متاحة ');
        return redirect()->back();
    }
    }

    public function success()
    {
        session()->flash('success', 'تم الدفع بنجاح المنتج قيد التنفيذ');
        return redirect()->back();
    }

    public function cancel()
    {
        session()->flash('cancel', 'فشلت عملية الدفع');
        return redirect()->back();
    }

    public function status1($id){
        clothingorder::find($id)->update([
            'status' => 'قبول',
        ]);
        return redirect()->back();
    }

    public function status2($id){
        clothingorder::find($id)->update([
            'status' => 'رفض',
        ]);
        return redirect()->back();
    }

    public function status3($id){
        clothingorder::find($id)->update([
            'status' => 'اتمام',
        ]);
        return redirect()->back();
    }
    public function destory(Request $request,$id){
        clothingorder::where('id', $request->id)->delete();
        session()->flash('delete', 'تم حذف الاوردر بنجاح');
        return redirect()->back();
    }
}
