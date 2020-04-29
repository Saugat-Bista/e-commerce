<!-- contains menu
contains slideshow -->
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.5.0.js" integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="CSS/layout.css" />
	<link rel="stylesheet" href="CSS/bootstrap_o.css" />
	<link rel="stylesheet" href="CSS/carousel.css" />
	<link rel="stylesheet" href="CSS/content.css" />
	<link rel="stylesheet" href="CSS/user_info.css" />

	<title>@yield('title')</title>
</head>

<body>

	<!-- menu: 
Retrieved from: https://getbootstrap.com/docs/4.0/components/navbar/ -->
	<nav class="navbar navbar-expand-md navbar-fixed-top navbar-dark bg-primary" id="navbar">
		<!-- <nav class="navbar navbar-inverse navbar-expand-md navbar-fixed-top" id="navbar"> -->

		<!-- Brand -->
		<a class="navbar-brand" href="/"><img width="50" height="30" src="Images/logo.png" alt="Shopping Website Logo"></a>
		<!-- Toggler/collapsibe Button -->
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
			<span class="navbar-toggler-icon"></span>
		</button>
		<!-- Navbar links -->
		<div class="collapse navbar-collapse" id="collapsibleNavbar">
			<ul class="navbar-nav navbar-left">
				<li class="nav-item {{ Route::currentRouteNamed( 'allProducts' ) ?  'active' : '' }}">
					<a class="nav-link" href="/all">All Products</a>
				</li>
				<li class="nav-item {{ Route::currentRouteNamed( 'newRelease' ) ?  'active' : '' }}">
					<a class="nav-link" href="/new">New Releases</a>
				</li>
				<li class="nav-item {{ Route::currentRouteNamed( 'onSale' ) ?  'active' : '' }}">
					<a class="nav-link" href="/sale">On Sale</a>
				</li>
				<!-- Dropdown -->
				<li class="nav-item dropdown" style="display:none">
					<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
						Dropdown
					</a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="#">Item 1</a>
						<a class="dropdown-item" href="#">Item 2</a>
						<a class="dropdown-item" href="#">Item 3</a>
						<a class="dropdown-item" href="#">Item 4</a>
					</div>
				</li>
			</ul>
			<ul class="navbar-nav navbar-right">
				<form class="form-inline my-2 my-lg-0" action="search" method="get">
					<input class="form-control mr-sm-2" name="searchText" autocomplete="off" type="text" placeholder="Search" />
				</form>

				<li class="nav-item {{ Route::currentRouteNamed( 'cartPage' ) ?  'active' : '' }}">
					<a class="nav-link" href="/cart">
						<i class="glyphicon glyphicon-shopping-cart"></i>
						@if(Session::has('cart'))
						<span id="totalQuantity" class="cart-with-numbers">
							{{Session::get('cart')->totalQuantity}}
						</span>
						@else
						<span id="totalQuantity" class="cart-with-numbers">0</span>
						@endif
						Cart</a>
				</li>

				@if (Auth::check())
				<li class="nav-item"><a class="nav-link" href="/home"><i class="glyphicon glyphicon-user"></i> Profile</a></li>
				@else
				<li class="nav-item"><a class="nav-link" href="/login"><i class="glyphicon glyphicon-lock"></i> Login</a></li>
				@endif

			</ul>
		</div>
	</nav>
	<br>

	<!-- Problems with navbar:
Navbar doesnt load properly
Fix active links -->

	<!--slider
Retrieved from: https://www.w3schools.com/bootstrap/bootstrap_carousel.asp -->
	<section id="slider" class="content">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-interval="3000" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
							<li data-target="#slider-carousel" data-slide-to="3"></li>
						</ol>

						<div class="carousel-inner">
							@foreach($sliders as $product)
							{{csrf_field()}}
							<div class="item @if($loop->first) active @endif">
								<h1>Top Selling Products (Over 70 Units Sold):</h1>
								<div class="col-sm-6">
									<h2>{{$product->name}}</h2>
									<p>Category: {{$product->category}}</p>
									<p>{{$product->description}}</p>
									<p>Price: ${{$product->price}}</p>
									<button class=" Ajax btn btn-default get btnfloat">
										<div id="url" style='display:none'>
											{{route('Ajax', ["id"=>$product->id])}}
										</div>
										<i class="glyphicon glyphicon-shopping-cart"></i> Add to Cart
									</button>
								</div>
								<div class="col-sm-6">
									<img src="{{Storage::disk('local')->url('product_images/'.$product->image)}}" class="img-responsive" alt='' />
								</div>
							</div>
							@endforeach

						</div>

						<a class="carousel-control-prev" href="#slider-carousel" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="carousel-control-next" href="#slider-carousel" role="button" data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					</div>

				</div>
			</div>
		</div>
	</section>
	<!--/slider-->
	<br>