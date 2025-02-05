<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\order;
use App\Models\message;
use App\Models\product;
use App\Models\Product_Image;
use App\Models\section;
use App\Models\Product_Image_Admin;
use App\Models\customer;
use App\Models\relationsize;
use Illuminate\Http\Request;
use App\Models\clothingorder;
use App\Models\clothingproduct;
use App\Models\clothingsection;
use App\Models\Color_Product;
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
        $products = product::paginate(9);

        return view('user_page.home', compact('products', 'messages'));
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

    public function markall(){
        $user = User::where('id', Auth::user()->id)->first();
        foreach($user->unreadNotifications as $notifiate){
            $notifiate->MarkAsRead();
        }
        return redirect()->back();
    }

    public function show_single_product($id){
        $product = product::where('id', $id)->first();
        $get_id = DB::table('notifications')->where('data->pro_id', $id)->where('notifiable_id', Auth::user()->id)->pluck('id');
        DB::table('notifications')->where('id', $get_id)->update(['read_at' => now()]);
        return view('user_page.view_single_product', compact('product'));
    }

    public function Previousorders()
    {
        $customer = customer::where('email', Auth::user()->email)->first();
        $orders = order::where('customer_id', $customer->id)->paginate(5);
        $clothingorders = clothingorder::where('customer_id', $customer->id)->get();
        return view('user_page.Previousorders', compact('orders', 'clothingorders'));
    }
    
    public function bestseller()
    {
        $products = order::select('product_id', DB::raw('count(*) as total'))->groupBy('product_id')->having('total', '>', 5) ->orderByDesc('total')->take(10)->paginate(8);
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
        })->paginate(9);

        $productIds = clothingorder::where('customer_id', $customer->id)->pluck('product_id')->toArray();
        $clothingproducts = clothingproduct::whereIn('id', $productIds)->get();
        $clothingsection = $clothingproducts->pluck('section_id');
        $clothingsections = clothingproduct::whereIn('section_id', $clothingsection)->paginate(9);
        return view('user_page.importantproducts', compact('sections', 'clothingsections'));
        
    }

    public function contact()
    {
        return view('user_page.contact');
    }
    
    public function shop()
    {
    return view('user_page.shop');
    }
    

    public function section_viewproduct(Request $request, $id)
    {
        $query = $request->input('search');
        $products = Product::where('section_id', $id)
            ->where(function ($q) use ($query) {
                $q->where('name->ar', 'LIKE', "%{$query}%")
                    ->orWhere('name->en', 'LIKE', "%{$query}%")
                    ->orWhere('description->ar', 'LIKE', "%{$query}%")
                    ->orWhere('description->en', 'LIKE', "%{$query}%");
            })
            ->paginate(10);
            $section = section::where('id', $id)->first();
        return view('user_page.view_product', compact('products', 'section'));
    }
        
    public function viewsingleproduct($id)
    {
    $product = product::where('id', $id)->first();
    $images = Product_Image_Admin::where('product_id', $id)->get();
    return view('user_page.view_single_product', compact('product', 'images'));
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
        $colors = Color_Product::where('product_id', $id)->get();
        $product = clothingproduct::where('id', $id)->first();
        $sizes = relationsize::where('product_id', $id)->get();
        $images = Product_Image::where('product_id', $id)->get();
        return view('user_page.view_single_clothingproduct', compact('product', 'sizes', 'colors', 'images'));
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
    ->size(['width' => 300, 'height' => 400]) 
    ->labels(['Order product', 'Order clothing'])
    ->datasets([
        [
            'backgroundColor' => ['#FF6384', '#36A2EB'],
            'hoverBackgroundColor' => ['#FF6384', '#36A2EB'],
            'data' => [order::count(), clothingorder::count()] 
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
                 'backgroundColor' => ['#B22222', '#4169E1', '#00FF7F'],
                 'data' => [$orderRejected, $Acceptorder, $ordercomplate] 
                ],
                ])
                ->options([]);
        return view('admin.index', compact('chart1', 'chartjs2'));
}

}