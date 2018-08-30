<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	<link href="https://bootswatch.com/4/materia/bootstrap.min.css" rel="stylesheet" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

	<!-- CSS for center align  -->
		<link rel="stylesheet" href="{{asset('css/mycss.css')}}">

	<!-- jQuery -->
	   <script
		  src="http://code.jquery.com/jquery-3.3.1.min.js"
		  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
		  crossorigin="anonymous">
		</script>
		<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
		<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

	<!-- jQuery validation -->
    <script>
    	$(document).ready(function(){
    		$("#loginForm").validate({
    			rules: {
    				email: {
    					required: true,
    					email: true
    				},
    				password: {
    					required: true
    				}
    			},
    			messages: {
    				email: {
    					required: "Please provide a email",
    					email: "Please provide a valid email id"
    				},
    				password: {
    					required: "Please provide a proper password"
    				}
    			},
	        	errorClass: "error-class",
				validClass: "valid-class"
    		});
    	});
    </script>
    <style type="text/css">
    	#card{
    		border: 5px solid aqua;
    	}
    	.error-class {
				color: #ff0000; /* red */
				display: block;
			}
			.valid-class {
				color: #00cc00; /* green */
			}
    </style>
</head>


</head>
<body>
	<center><br><br>
		@if(Session::has('message') && Session::has('success'))
		    <div class="alert {{ Session::get('success') ? 'alert-success' : 'alert-danger' }}">
		        {{Session::get('message')}}
		    </div>
		@endif
		<form method="post" action="/login" id="loginForm">
			@csrf				  
		  	<div id="card" class="card text-white bg-primary mb-3" style="max-width: 20rem;">
			  <div class="card-header"><h4>Login to Social Blog</h4></div>
			  <div class="card-body">
			    <h5 class="card-title">
			    	<label for="email">Email address</label>
					<input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email" required>
				</h5>
				<span>
					{{-- Display errors --}}
			          @if($errors->has('email'))
			            <div class="alert alert-danger">
			              {{$errors->first('email')}}
			            </div>
			          @endif
				</span>
				<h5 class="card-title">
					<label for="password">Password</label>
					<input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
				</h5>
				<span>
				{{-- Display errors --}}
			          @if($errors->has('password'))
			            <div class="alert alert-danger">
			              {{$errors->first('password')}}
			            </div>
			          @endif
			    </span>
				<button type="submit" class="btn btn-success float-left	">Login</button>
				<a href="/forgotUserPassword"><input type="button" name="forgotPassword" class="btn btn-warning float-right" value="Forgot Password"></a>
			  </div>
			</div>
		</form>
	</center>

</body>
</html>