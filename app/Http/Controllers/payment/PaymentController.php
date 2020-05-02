<?php

namespace App\Http\Controllers\payment;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function payment(){
        $payment_info = Session::get('payment_info');

        //has not paid
        if($payment_info['status'] == 'on_hold'){
            return view('paymentpage',['payment_info'=> $payment_info]);
         
        }
        //has paid
        else{
             return redirect()->route("allProducts");
        }    
    }

}
