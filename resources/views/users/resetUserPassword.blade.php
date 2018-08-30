<!DOCTYPE html>
<html>
<head>
	<title>Choose a new Password</title>

	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	<link href="https://bootswatch.com/4/materia/bootstrap.min.css" rel="stylesheet" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

	<!-- CSS for center align  -->
		<link rel="stylesheet" href="{{asset('css/mycss.css')}}">
</head>
<body>
<center>
	<form method="post" action="/newPasswordCreator">
		@csrf				  
	  	<div class="card text-white bg-primary mb-3" style="max-width: 20rem;">
		  <div class="card-header"><h4>Create a new password</h4></div>
		  <div class="card-body">
		    <h5 class="card-title">
		    	<label for="password">Password</label>
				<input type="password" class="form-control" id="password" name="password" placeholder="Password">
			</h5>
			
			<h5 class="card-title">
				<label for="Confirm Password">Confirm Password</label>
				<input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password">
			</h5>
			{{-- hidden fields --}}
			<input type="hidden" class="form-control" name="token" value='{{$token}}' required>
            <input type="hidden" class="form-control" name="user_id" value='{{$user_id}}' required>

			<button type="submit" class="btn btn-success ">Change Password</button>
		  </div>
		</div>
	</form>
</center>
</body>
</html>