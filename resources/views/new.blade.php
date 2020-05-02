@extends('layouts.index')
@section('title', 'New Releases')
@section('content')

<div class="container">
	<div class="content">
		<h1>Here are the latest products in the store</h1>
	</div>
	<div class="side sticky-top">
		<div class="side-top"></div>
		<div class="side-bottom">
			<h5>Filter Search
				<i class="glyphicon glyphicon-filter" style="padding-top:5px"></i></h5> <br>

			<div class="panel-group">
				<div class="panel panel-default">
					<div class="panel-heading">
						<a style="text-decoration:none; display:block" data-toggle="collapse" href="#collapse2">Gender <i class="glyphicon glyphicon-chevron-down"></i></a>
					</div>
					<div id="collapse2" class="panel-collapse collapse">
						<form style="padding-left:20px; padding-bottom:10px" action="/sidebarGender" method="get">
							<input type="radio" id="Male" name="gender" value="Male">
							<label for="Male">Male</label><br>
							<input type="radio" id="Female" name="gender" value="Female">
							<label for="Female">Female</label><br>
							<input type="radio" id="Unisex" name="gender" value="Unisex">
							<label for="Unisex">Unisex</label><br>
							<input type="submit" value="Submit">
						</form>
					</div>
				</div>
			</div>

			<div class="panel-group">
				<div class="panel panel-default">
					<div class="panel-heading">
						<a style="text-decoration:none; display:block" data-toggle="collapse" href="#collapse3">Price Range <i class="glyphicon glyphicon-chevron-down"></i></a>
					</div>
					<div id="collapse3" class="panel-collapse collapse">
					<form style="padding-left:20px; padding-bottom:10px" action="/sidebarPrice" method="get">
							<div class="card-body">
								<div class="form-row">
									<div class="form-group col-md-6">
										<label>Min</label>
										<input type="number" class="form-control" name="min_price" placeholder="$0">
									</div>
									<div class="form-group col-md-6 text-right">
										<label>Max</label>
										<input type="number" class="form-control" name="max_price" placeholder="$1,0000">
									</div>
									<input type="submit" value="Submit">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="gap"></div>
	<div class="mainbody">
		<div class="content">
			<h2>Press Add to Cart to Buy Products</h2>
		</div>
		<div class="row">
			@forelse($products as $product)
			<div class="col-sm-4 filter_data">
				<p class="img_padding">
					{{ csrf_field() }}
					<img src="{{Storage::disk('local')->url('product_images/'.$product->image)}}" class="img-responsive" width="250" height="250" alt='' />
					{{$product->name}}<br>
					${{$product->price}}<br>
					<button class="Ajax btn btn-default">
						<div id="url" style='display:none'>
							{{route('Ajax', ["id"=>$product->id])}}
						</div>
						<i class="glyphicon glyphicon-shopping-cart"></i> Add to Cart
					</button>
				</p>
			</div>
			@empty
			<div class="col-sm-4 sorry">
				No products available....
			</div>
			@endforelse
		</div>
		{{$products->links()}}

	</div><br>
</div>

<script src="JS/cart.js"></script>

@endsection