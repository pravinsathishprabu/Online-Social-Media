<?php 
session_start();
error_reporting(0);

	if(empty($_SESSION['user_info'])){
		echo "<script type='text/javascript'>alert('Please login before proceeding further!');</script>";
		echo"<script>window.open('login.php','_self')</script>";
	}
$conn = mysqli_connect("localhost","root","","webpro");
if(!$conn){  
	echo "<script type='text/javascript'>alert('Database failed');</script>";
  	die('Could not connect: '.mysqli_connect_error());  
}

		$query = mysqli_query($conn,"SELECT * FROM users WHERE email='$_SESSION[user_info]' ;");
		$row=mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>WEBBEE | POSTS</title>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<style type="text/css">
.but-box{
	width: 100%;
	color: black;
	height: auto;
	overflow-x: hidden;
}
</style>
</head>
<body class="bg-light">
<?php include ('nav.php');?>
<div style="margin-top: 20px;text-align: center;">
	<h2 class="text-dark">WEBBEE POSTS</h2>
	<p class="text-dark">Post something new and different</p>
</div>
<div class="container">
	<div class="p-3 bg-dark text-light" style="color: orange;text-align: center;border:5px solid orange;"><strong>Posts</strong></div>
	<div>
			<?php
						$post_query = "SELECT * FROM post ORDER BY post_id DESC LIMIT 50";
						$run_query= mysqli_query($conn,$post_query);
						while ($data = mysqli_fetch_array($run_query)) {
						
						$pu_name = $data['user_name'];
						$profile_query = mysqli_query($conn,"SELECT * FROM users WHERE uname='$pu_name' ;");
						$profile_row=mysqli_fetch_assoc($profile_query);
			?>	
			<div class="but-box bg-info p-4">
					<strong style="float:left;margin-top: 10px;margin-bottom: 10px;">
						<?php
						$pu_profile =$profile_row['profile'];
							if ($pu_profile==null) {
								echo "<img style='width:50px;height:50px;' src='img/man2.png'>";
							}
							else{
							echo "<img style='width:50px;height:50px;border-radius:40px;' src='profile/".$profile_row['profile']."'>";
							}
					?>&nbsp;<?php echo $data['user_name'];?></strong><br/><br/><br/><br/>
				<center>
				<?php
					echo "<a href='event.php?pid=".$data['post_id']."' style='color:black;'><img style='max-width:80%;border:2px solid black;background-color:white;padding:10px;max-height:90vh' src='posts/".$data['image']."'></a>";
					echo "<br>";
					echo "<strong style='text-align: center;color:white'>" .$data['post_text']."</strong>";
					echo "<br>";
					echo "<hr style='width:80%;margin-top:50px;background-color:black;color:black'/>";
					?>
				<?php	} ?>	

	 			</center>
	</div>
</div>
</body>
</html>