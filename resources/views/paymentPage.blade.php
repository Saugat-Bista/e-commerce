@extends('layouts.index2')
@section('title', 'User Info')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs" style="padding-top:10px">
            <ol class="breadcrumb">
                <li><a href="{{route('allProducts')}}">Home</a></li>
                <li><a href="{{route('cartPage')}}">Shopping Cart</a></li>
                <li><a href="{{route('userInfoPage')}}">User Information</a></li>
                <li class="active">Payment Page</li>
            </ol>
        </div>

        <form action="{{route('postPaymentPage')}}" method="post">
            {{csrf_field()}}

            <div class="row">
                <div class="col-50">
                <h3>Payment</h3>
                <label for="fname">Accepted Cards</label>
                <div class="icon-container">
                <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
                </div>
                <label for="cname">Name on Card</label>
                <input type="text" id="cname" name="cardname" placeholder="John More Doe">
                <label for="ccnum">Credit card number</label>
                <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
                <label for="expmonth">Exp Month</label>
                <input type="text" id="expmonth" name="expmonth" placeholder="September">

                <div class="row">
                    <div class="col-50">
                        <label for="expyear">Exp Year</label>
                        <input type="text" id="expyear" name="expyear" placeholder="2018">
                    </div>
                    <div class="col-50">
                        <label for="cvv">CVV</label>
                        <input type="text" id="cvv" name="cvv" placeholder="352">
                    </div>
                </div>
            </div>

    </div>
    <label>
        <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
    </label>
    <button class="btn btn-out" type="submit" name="submit">Charge Card</button>

    </form>

    </div>
</section>
<!--/#cart_items-->


@endsection