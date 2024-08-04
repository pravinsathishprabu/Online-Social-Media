<?php
session_start();
$conn = mysqli_connect("localhost","root","","webpro");
if(!$conn){  
	echo "<script type='text/javascript'>alert('Database failed');</script>";
  	die('Could not connect: '.mysqli_connect_error());  
}
if (isset($_POST['signup'])) 
{
	$name=$_POST['name'];
	$email=$_POST['email'];
	$mobile=$_POST['mobile'];
	$pass=$_POST['pass'];

	$sql="INSERT INTO users(uname,email,mobile,upass)VALUES('$name','$email','$mobile','$pass')";
	
	if (mysqli_query($conn, $sql)) {
			$message = "You have been successfully registered";
			echo"<script>window.open('login.php','_self')</script>";
		}else{
			$message = "Could not insert record"; 
	}
	echo "<script type='text/javascript'>alert('$message');</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>WEBBEE| Sign-up</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<style type="text/css">
	.form{
		margin-top: 80px;
	}
	.form-label{
		color: orange;
	}
</style>
</head>
 <body>
	<div class="head bg-primary">
		<h4 class="text-light p-4 text-center">SignUp</h4>
		<hr/>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-6">
	     		<lottie-player src="anime/sign.json"  background="transparent"  speed="1"  class="load"  loop  autoplay></lottie-player>
			</div>
			<div class="col-md-6">
			<form class="form" action="signup.php" method="post" autocomplete="off">
				<div class="mb-3"> 
					<h6 class='form-label'>User Name</h6>
					<input class="form-control" type="text" name="name" id="name" placeholder="Enter Name">
				</div>
				<div class="mb-3">
					<h6 class='form-label'>Email address</h6>
					<input class="form-control" type="email" name="email" id="email" placeholder="Enter Email address">
				</div>
				<div class="mb-3">
					<h6 class='form-label'>Mobile number</h6>
					<input class="form-control" type="tel" name="mobile" id="mobile" placeholder="Enter Mobile">	
				</div>
				<div class="mb-3">
					<h6 class='form-label'>Password</h6>
					<input class="form-control" type="password" name="pass" id="pass" placeholder="Enter Password">
				</div>
				<center>
					<div class="mb-3">
					<button class="btn btn-outline-success" name="signup" id="signup">Signup</button>
				</div>
				</center>
				<hr/>
				<h6 style="text-align: center;">Don't have an Account <a href="login.php" style="text-decoration: none;"> login here</a></h6></hr>
			</form>
		</div>
		
</body>
</html>