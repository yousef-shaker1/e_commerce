<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use App\Models\customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResponce;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\api\ApirequestTrait;

class CustomerController extends Controller
{
    use ApirequestTrait;

    public function index(){
        $customers = CustomerResponce::collection(customer::all());
        return $this->apiResponse($customers, 'ok', 200);
    }

    public function show($id){
        $customer = customer::find($id);
        if(!$customer){
            return $this->apiResponse(null, 'customer not found', 404);
        }
        return $this->apiResponse(new CustomerResponce($customer), 'ok', 200); 
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:6',
            'email' => 'required|unique:customers,email|between:2,100|email',
            'password' => 'required|min:6|max:16',
            'phone' => 'required|string',  
            'birthdate' => 'required|date', 
            'address' => 'required|between:5,100',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $customer = customer::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'roles_name' => ["user"],
        ]);

        return $this->apiResponse(new CustomerResponce($customer), "Created successfully", 201);

    }

    public function edit(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|min:6',
            'email' => 'nullable|between:2,100|email|unique:customers,email,',
            'password' => 'nullable|min:6|max:16',
            'phone' => 'nullable|string',  
            'birthdate' => 'nullable|date', 
            'address' => 'nullable|between:5,100',
        ]);
        
        // ابحث عن العميل المراد تحديثه
        $customer = customer::find($id);
        if (!$customer) {
            return $this->apiResponse(null, "Customer not found", 404);
        }
        
        $validatedData = $validator->validated();
        
        if ($request->has('password')) {
            $validatedData['password'] = bcrypt($request->password);
            User::where('email', $customer->email)->update([
                'password' => bcrypt($request->password),
            ]);
        }
        
        $customer->update($validatedData);
        

        return $this->apiResponse(new CustomerResponce($customer), "edit customer successfully",200);
    }

    public function delete($id){
        $customer = customer::find($id);
        if(!$customer){
            return $this->apiResponse(null, "customer not found",200);
        }
        $customer->delete();
        User::where('email', $customer->email)->delete();
        return $this->apiResponse(null, "delete customer successfully",200);
    }
}
