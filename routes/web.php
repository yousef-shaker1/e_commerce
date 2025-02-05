<?php

use Livewire\Livewire;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserpageController;
use App\Http\Controllers\ClothesbasketController;
use App\Http\Controllers\ClothingOrderController;
use App\Http\Controllers\ColthingBasketController;
use App\Http\Controllers\clothing_productController;
use App\Http\Controllers\clothing_sectionController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

 
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//+++++++++++++++++++++++userpage++++++++++++++++++++++++++++++++++++
Route::resource('/customer',CustomerController::class);


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){ 
        
        Route::controller(UserpageController::class)->group(function(){
            Route::get('/', 'index')->name('home');
            Route::get('/about', 'about')->name('about');
            Route::get('/shop','shop')->name('shop');
            Route::get('/contact','contact')->name('contact');
            Route::get('/bestseller', 'bestseller')->name('bestseller');
            Route::get('/notification/markall', 'markall')->name('notification.markall');
            Route::get('/show_single_product/{id}', 'show_single_product')->name('show_single_product');
            Route::get('/importantproducts', 'importantproducts')->name('importantproducts')->middleware('auth');
            Route::get('/Previousorders', 'Previousorders')->name('Previousorders')->middleware('auth');
            Route::Post('/mesage_customer', 'mesage_customer')->name('mesage_customer')->middleware('auth');
            //product
            // Route::get('/section/viewproduct/{id}', 'section_viewproduct')->name('section_product_view');
            Route::get('/section/viewproduct/{id}/{search?}','section_viewproduct')->name('section_product_view');
            Route::get('/viewproduct/{id}', 'viewsingleproduct')->middleware('auth')->name('product_view');
            //clothing_product
            Route::get('/clothingsection/product_view/{id}', 'clothing_section_viewproduct')->name('clothing_section_product_view');
            Route::get('/clothingproduct_view/{id}', 'clothing_viewproduct')->middleware('auth')->name('clothing_product_view');
            
        });
    });
    
//basket
Route::controller(BasketController::class)->group(function(){
    Route::get('/show_basket', 'show_basket')->name('show_basket')->middleware('auth');
    Route::get('/add_basket/{id}', 'add_basket')->name('add_basket');
    Route::get('/show_single_basket/{id}', 'show_single_basket')->name('show_single_basket');
    Route::delete('/del_clothing_basket/{id}', 'del_clothing_basket')->name('del_clothing_basket');
    Route::delete('/del_product_basket/{id}', 'del_product_basket')->name('del_product_basket');
});

//clothingbasket
Route::get('/add_clohing_basket/{id1}/{id2}', [ClothesbasketController::class, 'add_clothing_basket'])->name('add_clohing_to_basket');
Route::get('/show_single_clohing_basket/{id}', [BasketController::class, 'show_single_clohing_basket'])->name('show_single_clohing_basket');

//order
Route::Post('/send_order/{id}', [OrderController::class, 'send_order'])->name('send_order');
Route::get('/success', [OrderController::class, 'success'])->name('success');
Route::get('/cancel', [OrderController::class, 'cancel'])->name('cancel');
//clothing_order
Route::Post('/send_clothing_order/{id}', [ClothingOrderController::class, 'send_clothing_order'])->name('send_clothing_order');
Route::get('/success_clothing', [ClothingOrderController::class, 'success_clothing'])->name('success_clothing');
Route::get('/cancel_clothing', [ClothingOrderController::class, 'cancel_clothing'])->name('cancel_clothing');





//=====================adminpage=========================

Route::get('/dashboard', [UserpageController::class, 'dashboard'])->middleware(['auth', 'verified','Is_admin'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/all_customer', [CustomerController::class, 'allcustomer'])->name('all_customer');
    
Route::resource('/section', SectionController::class);
Route::resource('/product', ProductController::class);
Route::resource('/colthingsection', clothing_sectionController::class);
Route::resource('/colthingproduct', clothing_productController::class);

Route::get('/view_images/{id}', [ProductController::class, 'view_images'])->name('view_images');
Route::get('/show_images_product/{id}', [clothing_productController::class, 'show_images_product'])->name('show_images_product');
Route::get('/show_size', [clothing_productController::class, 'show_size'])->name('show_size');

// Route::Post('/add_new_size/{id}', [clothing_productController::class, 'addsize'])->name('addsize');
// Route::delete('/deletesize/{id}', [clothing_productController::class, 'deletesize'])->name('deletesize');
// Route::Post('/add_single_size/{id}', [clothing_productController::class, 'add_single_size'])->name('add_single_size');
Route::get('/show_size_product/{id}', [clothing_productController::class, 'show_size_product'])->name('show_size_product');
Route::resource('/order', OrderController::class);

Route::get('/show_message', [OrderController::class, 'show_message'])->name('show_message');
Route::delete('/del_massage/{id}', [OrderController::class, 'del_massage'])->name('del_massage');

Route::controller(ClothingOrderController::class)->group(function(){
    Route::get('/clothing_order', 'index')->name('clothing_order');
});

Route::get('/colors', [ColorController::class, 'index'])->name('colors');
Route::get('/show_color_product/{id}', [ColorController::class, 'show_color_product'])->name('show_color_product');
Route::get('/view_size_and_price/{id}', [ColorController::class, 'view_size_and_price'])->name('view_size_and_price');

//permission
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});
require __DIR__.'/auth.php';