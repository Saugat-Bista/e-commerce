<!-- for pages with no slideshow -->
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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
	<nav class="navbar navbar-expand-md sticky-top navbar-dark bg-primary" id="navbar">
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
				<li class="nav-item {{ Route::currentRouteNamed( 'cartPage' ) ?  'active' : '' }}">
					<a class="nav-link" href="/cart">
						<i class="glyphicon glyphicon-shopping-cart"></i>
						@if(Session::has('cart'))							
										    <span id="totalQuantity" class="cart-with-numbers">
											{{Session::get('cart')->totalQuantity}}
											</span>														  
										@endif						
						Cart</a>
				</li>

				@if (Auth::check())
				<li class="nav-item"><a class="nav-link" href="/home"><i class="glyphicon glyphicon-user"></i> Profile</a></li>
				@else
				<li class="nav-item"><a class="nav-link" href="/login"><i class="glyphicon glyphicon-lock"></i> Login</a></li>
				@endif

			</ul>
			<!-- <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form> -->
		</div>
	</nav>




	<br>
