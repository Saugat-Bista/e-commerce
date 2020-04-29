<?php

namespace App\Http\Controllers;

use App\Product;
use App\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{

    //Display All Products
    public function index()
    {
        // Get all results:
        // $sliders = DB::table('products')->get();
        $sliders = DB::table('products')->where('units_sold', '>=', 70)->get();
        $products = Product::paginate(9);
        $categories = DB::table('products')->distinct()->select('category')->get();
        return view("all", compact("products", "sliders"));
    }

    //Display New Release Products
    public function newProducts()
    {
        $sliders = DB::table('products')->where('units_sold', '>=', 70)->get();
        $products = Product::where('created_at', '>', '2019-12-30 23:59:59')->paginate(9);
        return view("new", compact("products", "sliders"));
    }

    //Display On Sale Products
    public function onSale()
    {
        $sliders = DB::table('products')->where('units_sold', '>=', 70)->get();
        $products = Product::where('on_sale', 'Y')->paginate(9);
        return view("onsale", compact("products", "sliders"));
    }

    public function showCart()
    {
        $cartItems = Session::get('cart');
        //change if statement to check for empty array
        if ($cartItems) {
            return view("cart", compact("cartItems"));
        } else {
            // Put an alert here
            return redirect()->route("allProducts");
        }
    }

    public function deleteFromCart(Request $request, $id)
    {
        $cart = $request->session()->get('cart');
        if (array_key_exists($id, $cart->items)) {
            unset($cart->items[$id]);
        }
        $prevCart = $request->session()->get('cart');
        $updatedCart = new Cart($prevCart);
        $updatedCart->updatePriceAndQuantity();
        $request->session()->put("cart", $updatedCart);
        return redirect()->route('cartPage');
    }

    public function increaseQuantity(Request $request, $id)
    {
        $prevCart = $request->session()->get('cart');
        $cart = new Cart($prevCart);
        $product = Product::find($id);
        $cart->addItem($id, $product);
        $request->session()->put('cart', $cart);
        return redirect()->route("cartPage");
    }

    public function decreaseQuantity(Request $request, $id)
    {
        $prevCart = $request->session()->get('cart');
        $cart = new Cart($prevCart);
        if ($cart->items[$id]['quantity'] > 1) {
            $product = Product::find($id);
            $cart->items[$id]['quantity'] = $cart->items[$id]['quantity'] - 1;
            $cart->items[$id]['totalSinglePrice'] = $cart->items[$id]['quantity'] * $product['price'];
            $cart->updatePriceAndQuantity();
            $request->session()->put('cart', $cart);
        }
        return redirect()->route("cartPage");
    }

    //Add to cart (regular method)
    // public function addToCart(Request $request, $id){
    //     $request->session()->forget('cart');
    //     $request->session()->flush();
    //     $prevCart = $request->session()->get('cart');
    //     $cart = new Cart($prevCart);
    //     $product = Product::find($id);
    //     $cart->addItem($id, $product);
    //     $request->session()->put('cart', $cart);
    //     return redirect()->route("allProducts");
    // }

    //Add to cart (Ajax Get)
    public function addToCartAjax(Request $request, $id)
    {
        $prevCart = $request->session()->get('cart');
        $cart = new Cart($prevCart);
        $product = Product::find($id);
        $cart->addItem($id, $product);
        $request->session()->put('cart', $cart);
        return response()->json(['totalQuantity' => $cart->totalQuantity]);
    }

    //Display Sidebar Gender Results
    public function sidebarGender(Request $request)
    {
        $sliders = DB::table('products')->where('units_sold', '>=', 70)->get();
        // $categories = DB::table('products')->distinct()->select('category')->get();
        $gender = $request->get('gender');
        $products = Product::where('type', "=", $gender)->paginate(9)->setPath('');
        $products->appends(array(
            'gender' => $request->get('gender'),
        ));
        return view("all", compact("products", "sliders"));
    }

    //Display Sidebar Price Results
    public function sidebarPrice(Request $request)
    {
        $sliders = DB::table('products')->where('units_sold', '>=', 70)->get();
        $min = $request->get('min_price');
        $max = $request->get('max_price');
        $products = Product::whereBetween('price', [$min, $max])->paginate(9)->setPath('');
        $products->appends(array(
            'min_price' => $request->get('min_price'),
            'max_price' => $request->get('max_price'),
        ));
        return view("all", compact("products", "sliders"));
    }

    public function search(Request $request)
    {
        $sliders = DB::table('products')->where('units_sold', '>=', 70)->get();
        $searchText = $request->get('searchText');
        $products = Product::where('name', "Like", "%" . $searchText . "%")->paginate(9)->setPath('');
        $products->appends(array(
            'searchText' => $request->get('searchText'),
        ));
        return view("all", compact("products", "sliders"));
    }

    // Display user info page
    public function userInfo()
    {
        return view("userInfoPage");
    }

    // Create Order
    public function createOrder(Request $request)
    {
        $cart = Session::get('cart');
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $address = $request->input('address');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $zip = $request->input('zip');

        $isLoggedIn = Auth::check();
        if ($isLoggedIn) {
            $user_id = Auth::id();
        } else {
            $user_id = 0;
        }

        if ($cart) {
            $date = date('Y-m-d H:i:s');
            $newOrderArray = array(
                "user_id" => $user_id, "status" => "on_hold", "date" => $date, "del_date" => $date, "price" => $cart->totalPrice,
                "first_name" => $first_name, "last_name" => $last_name, "address" => $address, "zip" => $zip, "phone" => $phone,
                "email" => $email
            );
            $created_order = DB::table("orders")->insert($newOrderArray);
            $order_id = DB::getPdo()->lastInsertId();

            foreach ($cart->items as $item) {
                $item_id = $item['data']['id'];
                $item_name = $item['data']['name'];
                $item_price = $item['data']['price'];
                $newItemsInCurrentOrder = array(
                    "item_id" => $item_id, "order_id" => $order_id, "item_name" => $item_name,
                    "item_price" => $item_price
                );
                $created_order_items = DB::table("user_orders")->insert($newItemsInCurrentOrder);
            }
            // Session::forget('cart');
            //Session::flush();
            $payment_info = $newOrderArray;
            $request->session()->put('payment_info', $payment_info);
            return redirect()->route("paymentPage")->with("success", "Order Created");
        } else {
            return redirect()->route("allProducts");
        }
    }
}
