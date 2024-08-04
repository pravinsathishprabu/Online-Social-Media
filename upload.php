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
//upload.php

if(isset($_POST['image']))
{
	$data = $_POST['image'];

	$image_array_1 = explode(";", $data);

	$image_array_2 = explode(",", $image_array_1[1]);
	$data = base64_decode($image_array_2[1]);

	$path_img = 'upload/' . time() . '.png';
	$image_name = ''.time().'.png';
	file_put_contents($path_img, $data);

}
if (isset($_POST['upload'])) {
		$id=$row['uid'];
		$sql = "UPDATE `users` SET `profile`='$image_name' WHERE `uid`='$id'";

		if ($conn->$sql) {
			echo "updated";
		}
		else{
			echo "no";
		}
	}
?>