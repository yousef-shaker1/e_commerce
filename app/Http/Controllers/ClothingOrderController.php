<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use App\Models\size;
use App\Mail\okorder;
use Barryvdh\DomPDF\Facade\Pdf;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Log;
use App\Models\customer;
use App\Models\relationsize;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use App\Models\clothesbasket;
use App\Models\clothingorder;
use App\Models\clothingproduct;
use App\Models\Color_Size;
use App\Models\Color_Product;
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
        return view('admin.clothing_order');
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
        $color_product = Color_Product::where('product_id', $id)->first();

        if ($color_product === null) {
            $size_product = null;
            $size_product_amount = 0;
            if ($request->count > $size->amount) {
                return back()->withErrors('الكمية المطلوبة تتجاوز الحد المتاح للمقاس.');//منغير اللوان
            }
        } else {
            $size_product = Color_Size::where('color_product_id', $color_product->id)
                ->where('size_id', $basket->size_id)
                ->first();
            $size_product_amount = $size_product->amount;
            if ($request->count > $size_product->amount) { 
                return back()->withErrors('الكمية المطلوبة تتجاوز الحد المتاح للمقاس.');
            }

        }


        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Send me money!!',
                        ],
                        'unit_amount' => $count * $clothing_product->price * 100,
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('success_clothing'),
            'cancel_url' => route('cancel_clothing'),
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
        if ($color_product == null) {
            $size->update([
                'amount' => $size->amount - $count,
            ]);
        } else {
            $size_product->update([
                'amount' => $size_product->amount - $count,
            ]);
        }
        $productName = $clothing_product->name;
        $address = $customer->address;
        Mail::to(Auth::user()->email)->send(new okorder($productName, $date, $address));

        clothesbasket::where('customer_id', $customer->id)->where('product_id', $id)->delete();

        return redirect()->away($session->url);
    }

    public function success_clothing()
    {
        try {
            // جلب الطلب الأحدث من قاعدة البيانات
            $clothingorder = clothingorder::latest()->first();

            // تحقق إذا كان الطلب موجودًا
            if (!$clothingorder) {
                session()->flash('error', 'لم يتم العثور على الطلب.');
                return redirect()->back();
            }

            // توليد QR Code
            $qrCode = new QrCode('Order ID: ' . $clothingorder->id);
            $qrCode->setSize(150);
            $writer = new PngWriter();
            $result = $writer->write($qrCode);

            // الحصول على محتوى الصورة كـ Base64
            $qrCodeImage = base64_encode($result->getString());

            // إعداد اسم الملف للفاتورة
            $filename = 'invoice_' . $clothingorder->id . '.pdf';

            // تحميل العرض
            $pdf = Pdf::loadView('clothing', compact('clothingorder', 'qrCodeImage'));
            return $pdf->download($filename);
        } catch (\Exception $e) {
            // إذا حدث خطأ، سيتم تسجيله ويمكنك عرض رسالة خطأ مناسبة
            Log::error('Error generating invoice: ' . $e->getMessage());
            session()->flash('error', 'حدث خطأ أثناء توليد الفاتورة.');
            return redirect()->back();
        }
    }

    public function cancel_clothing()
    {
        session()->flash('cancel', 'فشلت عملية الدفع');
        return redirect()->back();
    }

    public function status1($id)
    {
        clothingorder::find($id)->update([
            'status' => 'قبول',
        ]);
        return redirect()->back();
    }

    public function status2($id)
    {
        clothingorder::find($id)->update([
            'status' => 'رفض',
        ]);
        return redirect()->back();
    }

    public function status3($id)
    {
        clothingorder::find($id)->update([
            'status' => 'اتمام',
        ]);
        return redirect()->back();
    }
    public function destory(Request $request, $id)
    {
        clothingorder::where('id', $request->id)->delete();
        session()->flash('delete', 'تم حذف الاوردر بنجاح');
        return redirect()->back();
    }
}
