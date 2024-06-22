<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use App\Mail\okorder;
use App\Models\order;
use App\Models\message;
use App\Models\product;
use App\Models\customer;
use App\Mail\completedorder;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use App\Models\clothingproduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    function __construct()
    {
    $this->middleware('permission:اوردرات', ['only' => ['index']]);
    $this->middleware('permission:قبول الاوردر', ['only' => ['status1']]);
    $this->middleware('permission:رفض الاوردر', ['only' => ['status2']]);
    $this->middleware('permission:اتمام الاوردر', ['only' => ['status3']]);
    $this->middleware('permission:حذف الاوردر', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = order::paginate(10);
        return view('admin.order',compact('orders'));
    }

    public function send_order(Request $request,$id){
        $request->validate([
            'date' => 'required',
        ]);

    $product = product::where('id', $id)->first();
    $date = request()->input('date');
    $count = request()->input('count');
    if ($request->count < $product->amount){
        
        Stripe::setApiKey(config('services.stripe.secret'));
    
        $session = Session::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Send me money!!',
                        ],
                        'unit_amount' =>$count * $product->price * 100,
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('success'),
            'cancel_url' => route('cancel'),
        ]);
        $customer = customer::where('email', Auth::user()->email)->first();
        //Create order:
        Order::create([
            'customer_id' => $customer->id,
            'day' => $date,
            'product_id' => $id,
            'count' => $count,
            'status' => 'قبول',
        ]);


        $product->update([
            'amount' => $product->amount - $count,
        ]);
        $nameproduct = $product->name;
        
        $address = $customer->address;
        Mail::to(Auth::user()->email)->send(new completedorder($nameproduct, $date, $address));
            
        return redirect()->away($session->url);

    } else {
        session()->flash('error', 'للاسف الكمية غير متاحة ');
        return redirect()->back();
    }
    }
        
        
        /**
         * Show the form for creating a new resource.
         */
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        order::where('id',$request->id)->delete();
        return redirect()->back();
    }
    public function status1(string $id)
    {
        order::where('id',$id)->update([
            'status' => 'قبول',
        ]);
        return redirect()->back();
    }
    public function status2(string $id)
    {
        order::where('id',$id)->update([
            'status' => 'رفض',
        ]);
        return redirect()->back();
    }
    public function status3(string $id)
    {
        order::where('id',$id)->update([
            'status' => 'اتمام',
        ]);
        return redirect()->back();
    }

    public function show_message(){
        $messages = message::paginate(5);
        return view('admin.show_message', compact('messages'));
    }

    public function del_massage(Request $request, $id){
        $messages = message::where('id', $request->id)->delete();
        session()->flash('delete', 'تم حذف التعليق بنجاح');
        return redirect()->back();
    }
}
