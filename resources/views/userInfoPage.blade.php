@extends('layouts.index2')
@section('title', 'User Info')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs" style="padding-top:10px">
            <ol class="breadcrumb">
                <li><a href="{{route('allProducts')}}">Home</a></li>
                <li><a href="{{route('cartPage')}}">Shopping Cart</a></li>
                <li class="active">User Information</li>
            </ol>
        </div>

        <form action="{{route('createOrder')}}" method="post">
            {{csrf_field()}}

            <div class="row">
                <div class="col-50">
                    <h3>User Information</h3>
                    <label for="fname"><i class="glyphicon glyphicon-user"></i> First Name</label>
                    <input type="text" id="fname" name="first_name" placeholder="First Name*" required>
                    <label for="lname"><i class="glyphicon glyphicon-user"></i> Last Name</label>
                    <input type="text" id="lname" name="last_name" placeholder="Last Name*" required>
                    <label for="email"><i class="glyphicon glyphicon-envelope"></i> Email</label>
                    <input type="text" id="email" name="email" placeholder="example@example.com*" required>
                    <label for="email"><i class="glyphicon glyphicon-phone"></i> Phone</label>
                    <input type="text" name="phone" placeholder="123-456-789*" required> <br />
                </div>

                <div class="col-50">
                    <h3>Address</h3>
                    <label for="adr"><i class="glyphicon glyphicon-address-card-o"></i> Street Address</label>
                    <input type="text" id="adr" name="address" placeholder="542 W. 15th Street*" required>
                    <label for="city"><i class="glyphicon glyphicon-institution"></i> City</label>
                    <input type="text" id="city" name="city" placeholder="New York">
                    <label for="state">State</label>
                    <input type="text" id="state" name="state" placeholder="NY">
                    <label for="zip">Zip</label>
                    <input type="text" id="zip" name="zip" placeholder="10001*">
                </div>
            </div>
            <button class="btn btn-out" type="submit" name="submit">Proceed To Payment Page</button>
        </form>
</section>
<!--/#cart_items-->


<!-- To disable guests from making orders:
@if(Auth::check())
do this
@else

<div class="alert alert-danger" role="alert">
    <strong>Please!</strong> <a href="{{route('login') }}">Log in</a> or 
    <a href="{{route('register') }}">Register</a> to create an order!!
</div>

@endif -->


@endsection