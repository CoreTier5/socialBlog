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

<center>
	<div class="card text-white bg-primary mb-3" style="max-width: 20rem;">
	  <div class="card-header">Reset password</div>
	  <div class="card-body">
	    <h4 class="card-title">Reset your password from here</h4>
	    <p class="card-text"><a href="{{route('reset.password',['token' => $token,'user_id' => $user_id])}}"> Click here </a> to reset your password</p>
	  </div>
	</div>
</center>

</body>
</html>