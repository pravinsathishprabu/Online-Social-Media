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
?>
<!DOCTYPE html>
<html>
<head>
	<title>Wechat | Your Profile</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@500&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<body>
<?php
    include ('nav.php');
  ?>  
<style type="text/css">		
	.form1{
		 width:100%;
		 height:100%;
		 border: 20px solid blacks;
		 border-radius: 10px;
		 font-style: bold;
		 font-family: 'Fira Sans', sans-serif;
		 background-image: url('img/profilebg.png');
		 background-repeat: no-repeat;
		 padding: 20px;
		}
	.lb{
		 color: orangered;
		 font-style: bold;
		}
	body{
		background-color: white;
		overflow-x: hidden;
		}
</style>
	<?php
		$query = mysqli_query($conn,"SELECT * FROM users WHERE email='$_SESSION[user_info]' ;");
		$row=mysqli_fetch_assoc($query);
		?>
<div id="main">
<form class="form1">
	<div class="components">
		<h5 class="lb" style="margin-top: 30px;">User Profile:</h5><br>
		<a href="upt-profile.php" style="margin-left: 40px;">
		<?php
					$profile =$row['profile'];
						if ($profile==null) {
							echo "<img style='width:100px;height:100px;margin-top:0px' src='img/man2.png'>";

						}
						else{
						echo "<img style='width:100px;height:100px;border-radius:60px' src='profile/".$row['profile']."'>";
						}
				?></a>
				<br/>
				<b style="color: green;">(*Click Image For Update Profile) </b>
		</div>
		<div class="components">
			<h5 class="lb" style="margin-top: 10px;">User Id:</h5>
			<h6 style="margin-left: 50px"><?php echo $row['uid'];?></h6>
			<b style="color: green;">(*Can't change your User Id)</b>
		</div><br/>
		<div class="components">
			<h5 class="lb">User Name:</h5>
			<h6 style="margin-left: 30px"><?php echo $row['uname'];?></h6>
		</div><br>
		<div class="components">
			<h5 class="lb">Email Address:</h5>
			<h6 style="margin-left: 30px"><?php echo $row['email'];?></h6>
		</div><br>
		<div class="components">
			<h5 class="lb">Mobile Number:</h5>
			<h6 style="margin-left: 30px"><?php echo $row['mobile'];?></h6>
		</div><br>
			<hr>
			<button class="btn btn-warning" style="color: white;margin-left: 130px;" onclick="edit()">Edit <img src="img/edit.png" style="width:20px;height:20px"></button>
			</hr>
	</form>
<script type="text/javascript">
  function edit() {
    window.open("eprofile.php");
  }
</script>

</body>
</html>