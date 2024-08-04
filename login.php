<?php
session_start();
if (isset($_POST['submit']))
{
	$conn = mysqli_connect("localhost","root","","webpro");
if(!$conn){  
	echo "<script type='text/javascript'>alert('Database failed');</script>";
  	die('Could not connect: '.mysqli_connect_error());  
}
$email=$_POST['email'];
$pass=$_POST['pass'];
$sql = "SELECT * FROM users WHERE email = '$email' AND upass = '$pass'";
$sql_result = mysqli_query ($conn, $sql) or die ('request "Could not execute SQL query" '.$sql);
		$user = mysqli_fetch_assoc($sql_result);
		if(!empty($user)){
			$_SESSION['user_info'] = $user['email'];
			$message='Logged in successfully';
			echo"<script>window.open('home.php','_self')</script>";
		}
		else{
			$message = 'Wrong email or password.';
		}
	echo "<script type='text/javascript'>alert('$message');</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>WEBBEE | LOGIN</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
 <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
 <style type="text/css">
 	.form-label{
 		float: left;
 		color: orange;
 	}
 	.login{
 		margin-top: 140px;
 	}
 	@media screen and (max-width: 600px){
 		.load{
 			width: 50vh;
 			height: 50vh;
 		}
 		.login{
 			margin-top: 0px;
 		}
 	}
 </style>
</head>
<body>
	<div class="head bg-primary">
		<h4 class="text-center p-4 text-light">Login</h4>
		<hr/>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<center>
	     			<lottie-player src="anime/sign.json"  background="transparent"  speed="1"  class="load"  loop  autoplay></lottie-player>
	    		</center>
			</div>
			<div class="col-md-6 login">
				<center>
					<form class="form" action="login.php" method="post" autocomplete="off">
						<div class="mb-3">
							<h6 class="form-label mb-3">Email address</h6>
							<input class="form-control" type="email" name="email" placeholder="Enter Email address">
						</div>
						<div class="mb-3">
							<h6 class="form-label mb-3">Password</h6>
							<input class="form-control" type="password" name="pass" placeholder="Enter Password">
						</div>
						<div class="mb-3">
							<button class="btn btn-outline-success" name="submit" id="submit">Login</button>
			 			</div>	
	  					<hr>
						<h6>Don't have an account <a href="signup.php" style="text-decoration: none;">signup here</a></h6></hr>
					</form>
				</center>
			</div>
	</div>
</body>
</html>