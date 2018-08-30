<!DOCTYPE html>
<html>
<head>
	<title>Forgot password</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	<link href="https://bootswatch.com/4/materia/bootstrap.min.css" rel="stylesheet" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

	<!-- CSS for center align  -->
		<link rel="stylesheet" href="{{asset('css/mycss.css')}}">
</head>
<body>

<center><br><br>
	<form method="post" action="/forgotPassword" method="POST">
		@csrf				  
	  	<div class="card text-white bg-primary mb-3" style="max-width: 20rem;">
		  <div class="card-header"><h4>Reset Your password</h4></div>
		  <div class="card-body">
		  	<span>
		  		@if(Session::has('message') && Session::has('success'))
				    <div class="alert {{ Session::get('success') ? 'alert-success' : 'alert-danger' }}">
				        {{Session::get('message')}}
				    </div>
				@endif
			</span>
		    <h5 class="card-title">
		    	<label for="email">Enter your email address</label>
				<input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
			</h5>
			<span>
				{{-- Display errors --}}
		          @if($errors->has('email'))
		            <div class="alert alert-danger">
		              {{$errors->first('email')}}
		            </div>
		          @endif
			</span>
			<button type="submit" class="btn btn-warning ">Reset</button><br>
			<a href="{{route('user.login')}}"><input type="button" name="login" class="btn btn-success float-left" value="Login">
			<a href="/register"><input type="button" name="register" class="btn btn-info float-right" value="Register"></a>
		  </div>
		</div>
	</form>
</center>

</body>
</html>