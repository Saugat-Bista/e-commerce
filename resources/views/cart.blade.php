@extends('layouts.index2')
@section('title', 'Cart Page')
@section('content')
<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs" style="padding-top:10px">
			<ol class="breadcrumb">
				<li><a href="{{route('allProducts')}}">Home</a></li>
				<li class="active">Shopping Cart</li>
			</ol>
		</div>
		<div class="table-responsive cart_info">
			<table class="table table-condensed">
				<thead>
					<tr class="cart_menu">
						<td class="image">Item</td>
						<td class="description">Description</td>
						<td class="price">Price</td>
						<td class="quantity">Quantity</td>
						<td class="total">Total</td>
						<td></td>
					</tr>
				</thead>
				@foreach($cartItems->items as $item)
				<tr class="cart_items">
					<td class="cart_product">
						<a href=""><img src="{{Storage::disk('local')->url('product_images/'.$item['data']['image'])}}" width="100" height="100" alt=""></a>
					</td>
					<td class="cart_description">
						<p>{{$item['data']['name']}}</p>
						<p>{{$item['data']['type']}}</p>
					</td>
					<td class="cart_price">
						<p>${{$item['data']['price']}}</p>
					</td>
					<td class="cart_quantity">
						<div class="cart_quantity_button">
							<a class="cart_quantity_up" href="{{route('Plus', ['id' => $item['data']['id']])}}"> + </a>
							<input class="cart_quantity_input" type="text" name="quantity" value="{{$item['quantity']}}" autocomplete="off" size="2">
							<a class="cart_quantity_down" href="{{route('Minus', ['id' => $item['data']['id']])}}"> - </a>
						</div>
					</td>
					<td class="cart_total">
						<p class="cart_total_price">${{$item['totalSinglePrice']}}</p>
					</td>
					<td class="cart_delete">
						<a class="cart_quantity_delete" href="{{route('deleteProduct', ['id' => $item['data']['id']])}}">Delete All</a>
					</td>
				</tr>
				@endforeach
				<tr class="cart_total">
					<td><a class="btn btn-default" href="{{route('allProducts')}}">Shop More</a></td>
					<td></td>
					<td></td>
					<td>Total Quantity: <span>{{$cartItems->totalQuantity}}</span></td>
					<td>Grand Total: <span>${{$cartItems->totalPrice}}</span></td>
					<td><a class="btn btn-default" href="{{route('userInfoPage')}}">Check Out</a></td>
				</tr>
			</table>
		</div>
	</div>
</section>
@endsection