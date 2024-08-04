<?php 
session_start();
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
<?php

if (isset($_GET['delete'])) {
	$id = $_GET['delete'];
	$query = "DELETE FROM post WHERE post_id=$id";
	$delete_query=mysqli_query($conn,$query);

	if ($delete_query) {
		echo "<script>window.open('myposts.php','_self')</script>";
	}
	else{
		echo "no";
	}
}
?>