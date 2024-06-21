<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\message;
use App\Models\product;
use App\Models\section;
use App\Models\customer;
use App\Models\relationsize;
use Illuminate\Http\Request;
use App\Models\clothingorder;
use App\Models\clothingproduct;
use App\Models\clothingsection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class UserpageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = message::get();
        $products = product::get();
        $clothing_products = clothingproduct::get();
        return view('user_page.home', compact('products', 'clothing_products', 'messages'));
    }

    public function about()
    {
        $messages = message::get();
        return view('user_page.about', compact('messages'));
    }

    public function error()
    {
        return view('user_page.404');
    }

    public function cart()
    {
        return view('user_page.cart');
    }

    public function checkout()
    {
        return view('user_page.checkout');
    }

    public function Previousorders()
    {
        $customer = customer::where('email', Auth::user()->email)->first();
        $orders = order::where('customer_id', $customer->id)->get();
        $clothingorders = clothingorder::where('customer_id', $customer->id)->get();
        return view('user_page.Previousorders', compact('orders', 'clothingorders'));
    }
    
    public function bestseller()
    {
        $products = order::select('product_id', DB::raw('count(*) as total'))->groupBy('product_id')->having('total', '>', 5) ->orderByDesc('total')->take(10)->get();
        $clothing_products = clothingorder::select('product_id', DB::raw('count(*) as total'))->groupBy('product_id')->having('total', '>', 5) ->orderByDesc('total')->take(10)->get();
        return view('user_page.bestseller', compact('products', 'clothing_products'));
    }

    public function importantproducts()
    {
        $customer = Customer::where('email', Auth::user()->email)->first();
        $sections = Product::whereIn('section_id', function($query) use ($customer) {
            $query->select('section_id')
                ->from('products')
                ->whereIn('id', function($query) use ($customer) {
                $query->select('product_id')
                ->from('orders')
                ->where('customer_id', $customer->id);
                });
        })->get();

        $productIds = clothingorder::where('customer_id', $customer->id)->pluck('product_id')->toArray();
        $clothingproducts = clothingproduct::whereIn('id', $productIds)->get();
        // return $products;
        $clothingsection = $clothingproducts->pluck('section_id');
        $clothingsections = clothingproduct::whereIn('section_id', $clothingsection)->get();
        return view('user_page.importantproducts', compact('sections', 'clothingsections'));
        
    }

    public function contact()
    {
        return view('user_page.contact');
    }
    
    public function shop()
    {
    $sections = section::get();
    $clothing_sections = clothingsection::get();
    return view('user_page.shop', compact('sections', 'clothing_sections'));
    }
    

    public function section_viewproduct($id)
    {
    $products = product::where('section_id', $id)->get();
    $section = section::where('id', $id)->first();
    return view('user_page.view_product', compact('products', 'section'));
    }
        
    public function viewsingleproduct($id)
    {
    $product = product::where('id', $id)->first();
    return view('user_page.view_single_product', compact('product'));
    }
    
    public function mesage_customer(Request $request)
    {
        // return $request;
        $customer = customer::where('email', Auth::user()->email)->first();
        $request->validate([
            'message' => 'required|min:5',
        ]);

        message::create([
            'customer_id' => $customer->id,
            'message' => $request->message,
        ]);
        session()->flash('Add', 'تم اضافة تعليقك علي الموقع');
        return redirect()->back();
    }

    
    public function clothing_section_viewproduct($id)
    {
        $clothing_products = clothingproduct::where('section_id', $id)->get();
        $clothing_section = clothingsection::where('id', $id)->first();
        return view('user_page.view_clothing_product', compact('clothing_products', 'clothing_section'));
    }

    public function clothing_viewproduct($id)
    {
    $product = clothingproduct::where('id', $id)->first();
    $sizes = relationsize::where('product_id', $id)->get();
    return view('user_page.view_single_clothingproduct', compact('product', 'sizes'));
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function dashboard() 
    {
        $chart1 = app()->chartjs
        ->name('ordersPieChart')
        ->type('pie')
    ->size(['width' => 300, 'height' => 400]) // تعديل الحجم ليكون أكبر
    ->labels(['Order product', 'Order clothing'])
    ->datasets([
        [
            'backgroundColor' => ['#FF6384', '#36A2EB'],
            'hoverBackgroundColor' => ['#FF6384', '#36A2EB'],
            'data' => [order::count(), clothingorder::count()] // تعديل القيم بناءً على عدد الأوامر
        ]
        ])
    ->options([]);

    $orderRejected = order::where('status', 'رفض')->count() + clothingorder::where('status', 'رفض')->count(); 
    $Acceptorder = order::where('status', 'قبول')->count() + clothingorder::where('status', 'قبول')->count(); 
    $ordercomplate = order::where('status', 'اتمام')->count() + clothingorder::where('status', 'اتمام')->count(); 
    $chartjs2 = app()->chartjs
        ->name('barChartTest')
        ->type('bar')
        ->size(['width' => 450, 'height' => 300])
         ->labels(['الاوردرات المرفوضة' , 'الاوردرات المقبولة', 'الاوردرات التي تمت'])
         ->datasets([
             [
                //  "label" => "orderRejected","Acceptorder","ordercomplate",
                 'backgroundColor' => ['#B22222', '#4169E1', '#00FF7F'],//الغير مدفوعة + المدفوعة جزيا
                 'data' => [$orderRejected, $Acceptorder, $ordercomplate] // الغير مدفوعة / جزيا
                ],
                ])
                ->options([]);
        return view('admin.index', compact('chart1', 'chartjs2'));
}

}