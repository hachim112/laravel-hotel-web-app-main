<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Mermoura Hotel</title>
	<link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
	<style>
		body { font-family: 'Poppins', sans-serif; background: #f8f9fc; }
		.navbar { background: linear-gradient(90deg, #0d6efd, #0dcaf0); }
		.navbar-brand { font-weight: 600; font-size: 1.4rem; }
		.container { margin-top: 40px; }
	</style>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
		<div class="container">
			<a class="navbar-brand" href="{{ route('landing') }}">
				<i class="fas fa-hotel"></i> Mermoura Hotel
			</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav ms-auto">
					<li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
					<li class="nav-item"><a class="nav-link" href="#types">Rooms</a></li>
					<li class="nav-item"><a class="nav-link" href="#facilities">Facilities</a></li>
					<li class="nav-item"><a class="nav-link" href="#about">About</a></li>
					<li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
					@guest
						<li class="nav-item">
							<a class="nav-link btn btn-outline-light ms-2" href="{{ route('login') }}">
								<i class="fas fa-sign-in-alt"></i> Login
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link btn btn-success ms-2" href="{{ route('register') }}">
								<i class="fas fa-user-plus"></i> Register
							</a>
						</li>
					@endguest
				</ul>
			</div>
		</div>
	</nav>
	<div class="container">
		@yield('content')
	</div>
	<script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
	<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
</body>
</html>
