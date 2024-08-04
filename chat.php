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

include ('nav.php');

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<title>Webbee | Chat</title>
	<style type="text/css">
	.frds{	
		color: white;
		height: 50px;
		margin-top: 10px;
	}
	.but-box{
	  height: 90vh;
	  width: 100%;
	  padding: 10px;
	  border: 5px solid black;
	  margin: 0;
	  color: black;
	  background-color: whitesmoke;
}
.scrollbar3
{
	float: left;
	height: 400px;
	min-width: 100%;
	background: none;
	overflow-y: scroll;
}
.force-overflow
{
	min-height: 1000px;
}
#style-3::-webkit-scrollbar-track
{
	-webkit-box-shadow: inset 0 0 6px white;
	
}

#style-3::-webkit-scrollbar
{
	width: 2px;
}

	</style>
</head>
<body class="bg-dark text-light">
	<div class="col container" style="margin-top: 10px;">
	<div class="but-box">
	  <div style="border-radius:20px;">
			<?php
		       $profile = $row['profile'];
		        if ($profile == null) {
		           echo "<a href='profile.php'><img style='width:50px;height:50px;margin-top:10px;margin-left:10px' src='img/man2.png'></a>";
		        }
		        else{
		          echo "<a href='profile.php'><img style='width:50px;height:50px;border-radius:40px;margin-left:10px;' src='profile/".$row['profile']."'></a>";
		        }?>
      <hr style='height:2px;border-width:10px;color:white;background-color:black;'>
	  </div>
	<div class="users">
		<div class="scrollbar3" id="style-3">
    	  <div class="force-overflow">
			<?php
				$curr_uid = $row['uid'];
				$users_query = "SELECT * FROM users WHERE uid != $curr_uid;";
				$users_row=mysqli_query($conn,$users_query);
				while ($data = mysqli_fetch_array($users_row) ) {
				?>	
	  <div class="frds">
			<div class="but-frds" style="border:1px solid black;padding: 10px;">
					<?php
						$uname = $data['uname'];
						$pu_profile =$data['profile'];
						if ($pu_profile==null) {
							echo "<img style='width:35px;height:35px;' src='img/man2.png'>";
						}
						else{
							echo "<img style='width:35px;height:35px;border-radius:25px;' src='profile/".$data['profile']."'>";
							}
						echo "<a href='startchat.php?auser=".$data['uid']."'  style='color:black;text-decoration:none' onclick='open()'><strong style='font-size:17px;margin-top:10px;'>&nbsp;&nbsp;$uname</strong></a>";?>
				</div>
			</div>
			<?php
				if (isset($_GET['auser']))
				{
					$aid = $_GET['auser'];
					$choose_auser_query = mysqli_query($conn,"SELECT * FROM users WHERE uid='$aid';");
					$auser_data=mysqli_fetch_assoc($choose_auser_query);
						  }
					  }?>
	</div>
 </div>
</div>
</div>
</div>
</body>
</html>