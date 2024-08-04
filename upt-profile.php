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
<?php
		$query = mysqli_query($conn,"SELECT * FROM users WHERE email='$_SESSION[user_info]' ;");
		$row=mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html>
<head>
	<title>WEBBEE | Update Profile</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<style type="text/css">
	.profile{
		height: 50vh;
	}
</style>
<body style="background-color: white;">
	<?php
    include ('nav.php');
  ?>
<div id="main"style="margin-top: 5px;" >
<center>
<?php
$profile =$row['profile'];
if ($profile==null) {
	echo "<img class='profile' src='img/man2.png'>";

}
else{
echo "<img style='max-width:50%;max-height:50%;' src='profile/".$row['profile']."'>";
}
?>
<form method="POST" action="upt-profile.php" enctype="multipart/form-data" class="form_post">
				<button class="btn btn-primary" style="margin-top: 5px;">
			<input  type="file" name="uploadfile" enctype="multipart/form-data"  value="Choose"/></button><br>
				<button type="submit" class="btn btn-success" style="color: white;margin-top: 20px;" name="upload"><img src="img/picture.png" style="height:20px;width:20px;"/>UPDATE</button>
				<button type="submit" class="btn btn-warning" style="color: white;margin-left: 100px;margin-top: 20px;"  onclick="RefreshPage()"><img src="img/loading.png" style="height:20px;width:20px;"/>&nbsp;Refresh</button>

	</form>
</center>
<script type="text/javascript">
	function RefreshPage()
	{
		location.reload();
	}

	</script>
<?php
$msg = "";

if (isset($_POST['upload'])) {
	$id=$row['uid'];
	$filename = $_FILES["uploadfile"]["name"];
	$tempname = $_FILES["uploadfile"]["tmp_name"];	
		$folder = "profile/".$filename;
			
		$sql = "UPDATE `users` SET `profile`='$filename' WHERE `uid`='$id'";

		move_uploaded_file($tempname, $folder);
	
		if (mysqli_query($conn, $sql)) {
			echo "<script type='text/javascript'>alert('Profile Pic Updated Successfully');</script>";
		}else{
			echo "<script type='text/javascript'>alert('Failed! Retry');</script>";
	}
}
?>
</body>
</html>