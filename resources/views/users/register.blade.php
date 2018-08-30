<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

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

		<script type="text/javascript">
			$(document).ready(function(){
				$("#formRegister").validate({
					rules:{
						firstName: "required",
						lastName: "required",
						email:{
							required: true,
							email: true
						},
						password: {
							required: true,
							minlength: 8

						},
						confirmPassword:{
							required: true,
							equalTo: "#password"
						},
						checkbox: {
							required: true
						}
					},
					messages:{
						firstName: {
							required: "Please provide a first name"
						},
						lastName: {
							required: "Please provide a last name"
						},
						email: {
							required: "Please provide a email",
							email: "Please enter a valid email"
						},
						password: {
							required: "Please enter a password",
							minlength: "Your password should be minimum 8 character long"
						},
						confirmPassword: {
							required: "Please confirm the password you entered",
							equalTo: "Password and confirm password should be same"
						},
						checkbox: {
							required: "Please accept the terms and condition"
						}
					},
					errorClass: "error-class",
					validClass: "valid-class"
				});
			});
		</script>

		{{-- style for errors --}}
		<style type="text/css">
			.error-class {
				color: #ff0000; /* red */
				display: block;
			}
			.valid-class {
				color: #00cc00; /* green */
			}
			form{
				border: 5px solid lime
			}
			.inner{
				padding-top: 20px;
			}
			#login{
				padding-left: 20px;
			}
			#loginDiv{
				padding-top: 25px;
			}
		</style>
</head>
<body>
	<div class="outer">
		<div class="inner">
			<center>
				<div class="card text-white bg-warning mb-3" style="max-width: 25rem;">
					<form method="post" action="/registerNewUser" enctype="multipart/form-data" id="formRegister">
						@csrf
					  <fieldset>
					  	<div class="card-body">
						    <div class="card-header bg-primary"><h4>Create a new account in Social Blog</h4></div>
						    <div class="form-group">
						      <label for="firstName">First Name</label>
						      <input type="text" class="form-control" name="firstName" id="firstName" aria-describedby="emailHelp" placeholder="Enter first name">
						      {{-- Display firstName error --}}
					          @if($errors->has('firstName'))
					            <div class="alert alert-danger">
					              {{$errors->first('firstName')}}
					            </div>
					          @endif
						    </div>
						    <div class="form-group">
						      <label for="lastName">Last Name</label>
						      <input type="text" class="form-control" name="lastName" id="lastName" aria-describedby="emailHelp" placeholder="Enter last name">
						      {{-- Display lastName error --}}
					          @if($errors->has('lastName'))
					            <div class="alert alert-danger">
					              {{$errors->first('lastName')}}
					            </div>
					          @endif
						    </div>
						    <div class="form-group">
						      <label for="email">Email address</label>
						      <input type="email" class="form-control" name="email" id="email"  aria-describedby="emailHelp" placeholder="Enter email">
						      {{-- Display email error --}}
					          @if($errors->has('email'))
					            <div class="alert alert-danger">
					              {{$errors->first('email')}}
					            </div>
					          @endif
						    </div>
						    <div class="form-group">
						      <label for="password">Password</label>
						      <input type="password" class="form-control" id="password" name="password" placeholder="Password">
						      {{-- Display password error --}}
					          @if($errors->has('password'))
					            <div class="alert alert-danger">
					              {{$errors->first('password')}}
					            </div>
					          @endif
						    </div>
						    <div class="form-group">
						      <label for="confirmPassword">Confirm Password</label>
						      <input type="password" class="form-control" id="confrimPassword" name="confirmPassword" placeholder="Confirm Password"> <small>Must be same as password</small>
						      {{-- Display confirmPassword error --}}
					          @if($errors->has('confirmPassword'))
					            <div class="alert alert-danger">
					              {{$errors->first('confirmPassword')}}
					            </div>
					          @endif
						    </div>
						    <div class="form-check" style="margin: 0 65px;">
						        <label class="row form-check-label">
						          <span class="pull-right">I accept the <a href="/terms"> terms and condition</a>.</span>
						          <input class="form-check-input" name="checkbox" id="checkbox" type="checkbox">
						        </label>
						      {{-- Display checkbox error --}}
					          @if($errors->has('checkbox'))
					            <div class="alert alert-danger">
					              {{$errors->first('checkbox')}}
					            </div>
					          @endif
						     </div>
						    <input type="file" name="photo"  id="photo" class="form-control">
						  </fieldset>
						    <br>
						    <button type="submit" class="btn btn-primary">Submit</button><br>
						    <div id="loginDiv" class="form-group">
						  		<label for="login">Already has an account ?</label><a id="login"  href="{{ route('user.login') }}"><input type="button" name="login" class="btn btn-success" value="Login"></a>
						  	</div>
						  </div>
					  	</fieldset>
					</form>
				</div>
			</center>
		</div>
	</div>
</body>
</html>