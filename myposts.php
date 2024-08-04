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

	<style type="text/css">
 .form_post{
 	background-color: white;
 	width:100%;
 	overflow-x: hidden;
 }

.but-box{
  max-width: 80%;
  min-width: 40%;
  padding: 10px;
  border: 2px solid white;
  margin-top: 10px;
  border-radius: 20px;
  margin-top: 10px;
}

.but-box2{
  width: 100%;
  margin: 0;
  background-color:  white;
  color: black;
  margin-top: 10px;
}

</style>
	<!DOCTYPE html>
	<html>
	<head>
		<title>WEBBEE | My posts</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	</head>
	<body class="bg-light text-dark">
		<div>
		<?php
			include 'nav.php';
		?>
		</div>
	<div id="content" style="margin-top:10px;">
		<form method="POST" action="" enctype="multipart/form-data" class="form_post">
			<div>
			<h2 style="color:green;text-align: center;">WeBbEe My PoStS</h2>
	    <p style="text-align: center;">Post something new and different</p></div>

<center>

	<div class="but-box2 container">
		
				<button class="btn btn-info">
				<input  type="file" class="form-control mr-auto" name="uploadfile" enctype="multipart/form-data"  value="Choose" accept=".png,.jpg,.jpeg"/></button>
				<input type="text" class="form-control" style="padding: 10px;max-width:35%;" name="post_text" placeholder="Type something With Your Post" autocomplete="off" />
		<center><br/>
				<button type="submit" class="btn btn-success" style="width:130px" name="upload">
				<img src="img/picture.png" style="height:20px;width:20px;"/>&nbsp;UPLOAD</button>
			</center>
	</div>

		</form>
	</div>
	<br>
</center>
	<?php
	$user_name=$row['uname'];
	$post_query = mysqli_query($conn,"SELECT * FROM post WHERE user_name='$user_name';");
			
while ($data = mysqli_fetch_array($post_query) ) {	?>

	<center>
	<div style="font-family: 'Courgette', sans-serif;color: white">
<div class="but-box">
	<form action="myposts.php" method="post">
	<strong class="text-dark"><strong style="color: red;">Likes&nbsp;&nbsp;</strong><?php echo $data['likes']?></strong><br>

		<hr style="color:black;width:100%;background-color:black">
		<?php
		echo "<img style='max-width:80%;;max-height:70vh;' src='posts/".$data['image']."'>";
		echo "<br>";
		echo "<strong style='text-align: center;font-size: 20px;color:#3385ff;'> ".$data['post_text']."</strong>";
		echo "<br>";
		echo "<p style='color: black;float:right;'>".$data['post_time']."</p>";
		echo "<br>";
		echo "<hr style='color:black;background-color:black;width:100%;'>";
		echo "<a href='process.php?delete=".$data['post_id']."' class='btn btn-danger'>Delete</a>";
		?>
		<br>
	</form>
		</div>
	</div>

<?php

}
?>
<?php
$msg = "";

// If upload button is clicked ...
if (isset($_POST['upload'])) {
	$username=$row['uname'];
	$post_text = $_POST['post_text'];
	$filename = $_FILES["uploadfile"]["name"];
	$tempname = $_FILES["uploadfile"]["tmp_name"];	
		$folder = "posts/".$filename;
		
	$db = mysqli_connect("localhost", "root", "", "webpro");

		// Get all the submitted data from the form
		$sql = "INSERT INTO post (user_name,image,post_text) VALUES ('$username','$filename','$post_text')";

		// Execute query
		move_uploaded_file($tempname, $folder);
		// Now let's move the uploaded image into the folder: image
		if (mysqli_query($db, $sql)) {
			echo "<script type='text/javascript'>alert('Your post was uploaded successfully');</script>";
			echo"<script>window.open('myposts.php','_self')</script>";
			exit();
		}else{
			echo "<script type='text/javascript'>alert('Failed to Upload! Retry');</script>";
	}
}

?>

	</body>
	</html>
