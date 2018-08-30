<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<?php
	session_start();
	if (!$_SESSION['email']) {
		header('Location: index.php');	
		exit();
	}

?>

<div class="alert alert-success">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	<?php
		echo $_SESSION['success'];
	?>	
</div>
<h2>Welcome,</h2> <h1><?php echo $_SESSION['f_name'];?> <?php echo $_SESSION['l_name'];?></h1>
<a href="backend/functionality.php">logout</a>
</body>
</html>