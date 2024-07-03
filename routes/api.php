<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\SizeController;
use App\Http\Controllers\api\OrderController;
use App\Http\Controllers\api\BasketController;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\SectionController;
use App\Http\Controllers\api\CustomerController;
use App\Http\Controllers\api\RelationSizeController;
use App\Http\Controllers\api\ClothingOrderController;
use App\Http\Controllers\api\ClothingBasketController;
use App\Http\Controllers\api\ClothingProductController;
use App\Http\Controllers\api\ClothingSectionController;
use App\Http\Controllers\api\CommentCustomerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']] , function(){
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('userProfile', [AuthController::class, 'userProfile']);
    Route::post('refresh', [AuthController::class, 'refresh']);
});

Route::group(['middleware' => ['user.token']] , function(){
    Route::get('/customer',[CustomerController::class, 'index']);
    Route::get('/customer/{id}',[CustomerController::class, 'show']);
    Route::post('/customer/create',[CustomerController::class, 'store']);
    Route::post('/customer/edit/{id}',[CustomerController::class, 'edit']);
    Route::delete('/customer/{id}',[CustomerController::class, 'delete']); 
   
    Route::get('/size',[SizeController::class, 'index']);
    Route::get('/size/{id}',[SizeController::class, 'show']);
    Route::post('/size/create',[SizeController::class, 'store']);
    Route::post('/size/edit/{id}',[SizeController::class, 'update']);
    Route::delete('/size/{id}',[SizeController::class, 'delete']);
   
    Route::get('/section',[SectionController::class, 'index']);
    Route::get('/section/{id}',[SectionController::class, 'show']);
    Route::post('/section/create',[SectionController::class, 'store']);
    Route::post('/section/edit/{id}',[SectionController::class, 'update']);
    Route::delete('/section/{id}',[SectionController::class, 'delete']);
   
    Route::get('/product',[ProductController::class, 'index']);
    Route::get('/product/{id}',[ProductController::class, 'show']);
    Route::post('/product/create',[ProductController::class, 'store']);
    Route::post('/product/edit/{id}',[ProductController::class, 'update']);
    Route::delete('/product/{id}',[ProductController::class, 'delete']);
    
     Route::get('/message',[CommentCustomerController::class, 'index']);
     Route::get('/message/{id}',[CommentCustomerController::class, 'show']);
     Route::delete('/message/{id}',[CommentCustomerController::class, 'delete']);
    
     Route::get('/clothingsection',[ClothingSectionController::class, 'index']);
     Route::get('/clothingsection/{id}',[ClothingSectionController::class, 'show']);
     Route::post('/clothingsection/create',[ClothingSectionController::class, 'store']);
     Route::post('/clothingsection/edit/{id}',[ClothingSectionController::class, 'update']);
     Route::delete('/clothingsection/{id}',[ClothingSectionController::class, 'delete']);
    
     Route::get('/clothingproduct',[ClothingProductController::class, 'index']);
     Route::get('/clothingproduct/{id}',[ClothingProductController::class, 'show']);
     Route::post('/clothingproduct/create',[ClothingProductController::class, 'store']);
     Route::post('/clothingproduct/edit/{id}',[ClothingProductController::class, 'update']);
     Route::delete('/clothingproduct/{id}',[ClothingProductController::class, 'delete']);
    
     Route::get('/basket',[BasketController::class, 'index']);
     Route::get('/basket/{id}',[BasketController::class, 'show']);
     Route::post('/basket/create',[BasketController::class, 'store']);
     Route::delete('/basket/{id}',[BasketController::class, 'delete']);
    
     Route::get('/clothingbasket',[ClothingBasketController::class, 'index']);
     Route::get('/clothingbasket/{id}',[ClothingBasketController::class, 'show']);
     Route::post('/clothingbasket/create',[ClothingBasketController::class, 'store']);
     Route::delete('/clothingbasket/{id}',[ClothingBasketController::class, 'delete']);
     
    Route::get('/order',[OrderController::class, 'index']);
    Route::get('/order/{id}',[OrderController::class, 'show']);
    Route::put('/order/success/{id}',[OrderController::class, 'success']);
    Route::put('/order/rejection/{id}',[OrderController::class, 'rejection']);
    Route::put('/order/competed/{id}',[OrderController::class, 'completed']);
    Route::delete('/order/{id}',[OrderController::class, 'delete']);
     
    Route::get('/clothingorder',[ClothingOrderController::class, 'index']);
    Route::get('/clothingorder/{id}',[ClothingOrderController::class, 'show']);
    Route::put('/clothingorder/success/{id}',[ClothingOrderController::class, 'success']);
    Route::put('/clothingorder/rejection/{id}',[ClothingOrderController::class, 'rejection']);
    Route::put('/clothingorder/competed/{id}',[ClothingOrderController::class, 'completed']);
    Route::delete('/clothingorder/{id}',[ClothingOrderController::class, 'delete']);
    
    Route::get('/relationsize',[RelationSizeController::class, 'index']);
    Route::get('/relationsize/{id}',[RelationSizeController::class, 'show']);
    Route::post('/relationsize/create',[RelationSizeController::class, 'store']);
    Route::delete('/relationsize/{id}',[RelationSizeController::class, 'delete']);
});

