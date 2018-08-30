<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

	<!-- CSS for center align  -->
	<link rel="stylesheet" href="{{asset('css/mycss/center.css')}}">	
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
</head>
<body>
	<div class="outer">
		<div class="middle">
				@if(Session::has('message') && Session::has('success'))
				    <div class="alert {{ Session::get('success') ? 'alert-success' : 'alert-danger' }}">
				        {{Session::get('message')}}
				    </div>
				@endif
			<div class="inner">
				<center>
					@if(Auth::check())
						<div class="card text-white bg-dark mb-3" style="max-width: 20rem;">
						  <div class="card-header">Welcome</div>
						  <div class="card-body">
						    <h4 class="card-title">{{Auth::user()->firstName}}</h4>
						    <p class="card-text"> {{Auth::user()->email}} </p>
						    <a href="{{ route('user.logout') }}"><button type="button" class="btn btn-info">Logout</button></a>
						    <a href="{{ route('all.post') }}"><button type="button" class="btn btn-info">All Post</button></a>
						  </div>
						</div>
					@else
						<a href="{{ route('user.login') }}"><button type="button" class="btn btn-success" id="login">Login</button></a>
						<a href="{{url('/register')}}"><button type="button" class="btn btn-primary">Register</button></a>
					@endif
				</center>
			</div>
		</div>
	</div>
</body>
</html>