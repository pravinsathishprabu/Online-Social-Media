<?php 
session_start();
	if(empty($_SESSION['user_info'])){
		echo "<script type='text/javascript'>alert('Please login before proceeding further!');</script>";
		echo"<script>window.open('login.php','_self')</script>";
	}
$conn = mysqli_connect("localhost","root","","wechat");
if(!$conn){  
	echo "<script type='text/javascript'>alert('Database failed');</script>";
  	die('Could not connect: '.mysqli_connect_error());  
}?>
<?php
error_reporting(0);

$pid = $_GET['pid'];
$query = "DELETE FROM post WHERE post_id='$pid'";

$delete_query=mysqli_query($conn,$delete_query);
if ($query) {
	echo"<script>alert('deleted')</script>"
}
else{
	echo "<script>not deleted</script>";
}
?>