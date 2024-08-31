<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use App\Mail\okorder;
use App\Models\clothingproduct;
use Barryvdh\DomPDF\Facade\Pdf;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Log;
use App\Models\order;
use App\Models\basket;
use App\Models\message;
use App\Models\product;
use App\Models\customer;
use App\Mail\completedorder;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
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

        basket::where('customer_id', $customer->id)->where('product_id', $id)->delete();
        
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
        try {
            // جلب الطلب الأحدث من قاعدة البيانات
            $order = Order::latest()->first();
    
            // تحقق إذا كان الطلب موجودًا
            if (!$order) {
                session()->flash('error', 'لم يتم العثور على الطلب.');
                return redirect()->back();
            }
    
            // توليد QR Code
            $qrCode = new QrCode('Order ID: ' . $order->id);
            $qrCode->setSize(150);
            $writer = new PngWriter();
            $result = $writer->write($qrCode);
    
            // الحصول على محتوى الصورة كـ Base64
            $qrCodeImage = base64_encode($result->getString());
    
            // إعداد اسم الملف للفاتورة
            $filename = 'invoice_' . $order->id . '.pdf';
    
            // تحميل العرض
            $pdf = Pdf::loadView('invoice', compact('order', 'qrCodeImage'));
            return $pdf->download($filename);
    
        } catch (\Exception $e) {
            // إذا حدث خطأ، سيتم تسجيله ويمكنك عرض رسالة خطأ مناسبة
            Log::error('Error generating invoice: ' . $e->getMessage());
            session()->flash('error', 'حدث خطأ أثناء توليد الفاتورة.');
            return redirect()->back();
        }
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
        return view('admin.show_message');
    }

    public function del_massage(Request $request, $id){
        $messages = message::where('id', $request->id)->delete();
        session()->flash('delete', 'تم حذف التعليق بنجاح');
        return redirect()->back();
    }
}
