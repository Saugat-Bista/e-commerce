<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use Image;

class AdminProductsController extends Controller
{
    public function displayProducts()
    {
        $products = Product::paginate(8);
        return view("admin.displayProducts", ['products' => $products]);
    }

    public function editProducts($id)
    {
        $product = Product::find($id);
        return view("admin.editProducts", ['product' => $product]);
    }

    public function updateProducts(Request $request, $id)
    {
        $name = $request->input('name');
        $category = $request->input('category');
        $description = $request->input('description');
        $price = $request->input('price');
        date_default_timezone_set('America/New_York');
        $updated = date('Y-m-d H:i:s');
        Validator::make($request->all(), ['price' => "required|regex:/^\d*(\.\d{1,2})?$/"])->validate();
        $type = $request->input('type');
        $updateArray = array('name' => $name, 'updated_at' => $updated, 'category'=> $category, 'description' => $description, 'price' => $price, 'type' => $type);
        DB::table('products')->where('id', $id)->update($updateArray);
        return redirect()->route("adminDisplayProducts");
    }

    public function insertProducts()
    {
        return view("admin.insertProducts");
    }

    public function sendInsertProducts(Request $request)
    {
        $name = $request->input('name');
        $category = $request->input('category');
        $description = $request->input('description');
        $price = $request->input('price');
        $type = $request->input('type');
        date_default_timezone_set('America/New_York');
        $time = date('Y-m-d H:i:s');

        Validator::make($request->all(), ['price' => "required|regex:/^\d*(\.\d{1,2})?$/"])->validate();
        Validator::make($request->all(), ['image' => "required|image|mimes:jpg,png,jpeg|max:5000|dimensions:min_width=600,min_height=600"])->validate();
        $image = $request->file('image');
        $imageExt = $image->getClientOriginalExtension();
        $stringImageReformat = str_replace(" ", "", $name);
        $cleanName = preg_replace('/[^a-zA-Z0-9_ -]/s','', $stringImageReformat);
        $imageName = strtolower($cleanName . "." . $imageExt);

        // append image name
        $count=0;
        while(DB::table('products')->where('image', $imageName)->exists()){
            $count++;
            $imageName= strtolower($cleanName . $count. "." . $imageExt);
        }

        $path = public_path('storage/product_images/');
        $resizeImage = Image::make($image->getRealPath());
        $resizeImage->resize(600, 600)->save($path . '/' . $imageName);

        // $imageEncoded= File::get($request->image);
        // Storage::disk('local')->put("public/product_images/".$imageName, $imageEncoded);

        $newArray = array('name' => $name, 'created_at' => $time, 'updated_at' => $time, 'category'=> $category, 'description' => $description, 'image' => $imageName, 'price' => $price, 'type' => $type);
        $created = DB::table('products')->insert($newArray);
        if ($created) {
            return redirect()->route("adminDisplayProducts");
        } else {
            return "Product wasn't created";
        }
    }

    public function uploadProductImage($id)
    {
        $product = Product::find($id);
        return view("admin.editImage", ['product' => $product]);
    }

    public function updateProductImage(Request $request, $id)
    {
        Validator::make($request->all(), ['image' => "required|image|mimes:jpg,png,jpeg|max:5000|dimensions:min_width=600,min_height=600"])->validate();
        if ($request->hasFile("image")) {
            $product = Product::find($id);
            $exists = Storage::disk('local')->exists("public/product_images/" . $product->image);
            if ($exists) {
                Storage::delete("public/product_images/" . $product->image);
            }
            //upload new image
            $name = $product->name;
            $image = $request->file('image');
            $imageExt = $image->getClientOriginalExtension();
            $stringImageReformat = str_replace(" ", "", $name);
            $cleanName = preg_replace('/[^a-zA-Z0-9_ -]/s','', $stringImageReformat);
            $imageName = strtolower($cleanName . "." . $imageExt);

            $count=0;
            while(DB::table('products')->where('image', $imageName)->exists()){
                $count++;
                $imageName= strtolower($cleanName . $count. "." . $imageExt);
            }

            $path = public_path('storage/product_images/');
            $resizeImage = Image::make($image->getRealPath());
            $resizeImage->resize(600, 600)->save($path . '/' . $imageName);
            // $request->image->storeAs("public/product_images/", $product->image);
            // $arrayToUpdate= array('image'=>$imageName);
            // DB::table('products')->where('id', $id)->update($arrayToUpdate);
            return redirect()->route("adminDisplayProducts");
        } else {
            $error = "No Image Selected";
            return $error;
        }
    }

    public function removeProduct($id)
    {
        $product = Product::find($id);
        $exists = Storage::disk('local')->exists("public/product_images/" . $product->image);
        if ($exists) {
            Storage::delete("public/product_images/" . $product->image);
        }
        Product::destroy($id);
        return redirect()->route("adminDisplayProducts");
    }

    public function ordersPanel(){
        $orders= DB::table('orders')->paginate(10);
        return view("admin.ordersPanel", ['orders' => $orders]);
    }

    public function deleteOrder(Request $request, $id){
        $deleted= DB::table('orders')->where('order_id', $id)->delete();
        if($deleted){
            return redirect()->back()->with("orderDeletionStatus", 'Order '.$id.' deleted');
        }
        else{
            return redirect()->back()->with("orderDeletionStatus", 'Order '.$id.' not deleted');
        }
    }

    public function editOrderForm($id){
        $order= DB::table('orders')->where('order_id', $id)->get();
        return view("admin.editOrderForm", ['order'=> $order[0]]);
    }

    public function updateOrder(Request $request, $id){
        $date = $request->input('date');
        $del_date = $request->input('del_date');
        $price = $request->input('price');
        $status = $request->input('status');
        $updateArray= array('date'=>$date, 'del_date'=>$del_date, 'status'=>$status, 'price'=>$price);
        DB::table('orders')->where('order_id', $id)->update($updateArray);
        return redirect()->route("adminOrdersPanel");
    }
}
