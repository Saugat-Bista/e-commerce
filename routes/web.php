<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Simple get routes
Route::get('/', ['uses' => 'ProductsController@index']);
Route::get('all', ['uses' => 'ProductsController@index', 'as' => 'allProducts']);
Route::get('new', ['uses' => 'ProductsController@newProducts', 'as' => 'newRelease']);
Route::get('sale', ['uses' => 'ProductsController@onSale', 'as'=> 'onSale']);
Route::get('/cart', ['uses' => 'ProductsController@showcart', 'as' => 'cartPage']);

// Search box
Route::get('search', ['uses' => 'ProductsController@search', 'as' => 'search']);

// Sidebar results
Route::get('sidebarGender', ['uses' => 'ProductsController@sidebarGender', 'as' => 'sidebarGender']);
Route::get('sidebarPrice', ['uses' => 'ProductsController@sidebarPrice', 'as' => 'sidebarPrice']);

// Cart related routes
Route::get('product/addToCart/{id}', ['uses' => 'ProductsController@addToCart', 'as' => 'addToCart']);
Route::get('product/deleteProduct/{id}', ['uses' => 'ProductsController@deleteFromCart', 'as' => 'deleteProduct']);

// Checkout
Route::get('/userInfo', ['uses' => 'ProductsController@userInfo', 'as' => 'userInfoPage']);
Route::post('/createOrder', ['uses' => 'ProductsController@createOrder', 'as' => 'createOrder']);

//Payment Page
Route::get('/payment', ['uses' => 'payment\PaymentController@payment', 'as' => 'paymentPage']);
Route::post('/postPayment', ['uses' => 'payment\PaymentController@Postpayment', 'as' => 'postPaymentPage']);

// Ajax
Route::get('product/addToCartAjax/{id}/', ['uses' => 'ProductsController@addToCartAjax', 'as' => 'Ajax']);

// Add and Subtract Product Quantity
Route::get('product/increaseQuantity/{id}', ['uses' => 'ProductsController@increaseQuantity', 'as' => 'Plus']);
Route::get('product/decreaseQuantity/{id}', ['uses' => 'ProductsController@decreaseQuantity', 'as' => 'Minus']);

// Authentication
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

// Admin routes
Route::group(['middleware'=>'restrictToAdmin'], function(){

// Display products
Route::get('admin/products', ['uses' => 'Admin\AdminProductsController@displayProducts', 'as' => 'adminDisplayProducts']);

// Edit products
Route::get('admin/editproducts/{id}', ['uses' => 'Admin\AdminProductsController@editProducts', 'as' => 'adminEditProducts']);
Route::post('admin/updateproducts/{id}', ['uses' => 'Admin\AdminProductsController@updateProducts', 'as' => 'adminUpdateProducts']);

// Insert products
Route::get('admin/insertproducts', ['uses' => 'Admin\AdminProductsController@insertProducts', 'as' => 'adminInsertProduct']);
Route::post('admin/sendInsertproducts', ['uses' => 'Admin\AdminProductsController@sendInsertProducts', 'as' => 'adminSendInsertProducts']);

// Update product image
Route::get('admin/uploadImage/{id}', ['uses' => 'Admin\AdminProductsController@uploadProductImage', 'as' => 'adminUploadImage']);
Route::post('/admin/updateproductimage/{id}', ['uses' => 'Admin\AdminProductsController@updateProductImage', 'as' => 'adminUpdateProductImage']);

// Remove product
Route::get('admin/removeProduct/{id}', ['uses' => 'Admin\AdminProductsController@removeProduct', 'as' => 'adminRemoveProduct']);

// Order Panel
Route::get('admin/ordersPanel', ['uses' => 'Admin\AdminProductsController@ordersPanel', 'as' => 'adminOrdersPanel']);

//Delete Order as Admin
Route::get('admin/deleteOrder/{id}', ["uses"=>"Admin\AdminProductsController@deleteOrder", 'as'=>'adminDeleteOrder']);

//Edit & Update Product as Admin
Route::get('admin/editOrderForm/{id}', ["uses"=>"Admin\AdminProductsController@editOrderForm", 'as'=>'adminEditOrderForm']);
Route::post('admin/updateOrder/{id}', ["uses"=>"Admin\AdminProductsController@updateOrder", 'as'=>'adminUpdateOrder']);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
