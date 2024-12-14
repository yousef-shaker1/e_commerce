<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\check_register;

class CustomerController extends Controller
{
    function __construct()
    {
    $this->middleware('permission:العملاء', ['only' => ['index']]);
    
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(check_register $request)
    {
        customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'birthdate' => $request->birthdate,
            'address' => $request->address,
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'roles_name' => ["user"]
        ]);
        Session()->flash('add', 'تم التسجيل بنجاح');
        return redirect()->back();
    }

    public function allcustomer()
    {
        $customers = customer::paginate(7);
        return view('admin.all_customer', compact('customers'));
    }
    /**
     * Display the specified resource.
     */
    public function show(customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(customer $customer)
    {
        //
    }
}
