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
function getPosts()
{
	$posts=array();
	$posts[0]=$_POST['uid'];
	$posts[1]=$_POST['name'];
	$posts[2]=$_POST['email'];
	$posts[3]=$_POST['mobile'];

	return $posts;
}
if (isset($_POST['update'])) 
{
	$data = getPosts();

	$update_query = "UPDATE `users` SET `uname`='$data[1]',`email`='$data[2]',`mobile`='$data[3]' WHERE `uid`='$data[0]'";
	if(mysqli_query($conn, $update_query))
	{ 
    	echo '<script>alert("Record was updated successfully.")</script>'; 
		} 
		else
		 { 
		    echo "ERROR: Could not able to execute $update_query. "  
		                            . mysqli_error($con); 
		}  
}
if (isset($_POST['delete'])) 
{
	$data=getPosts();

	$delete_query = "DELETE FROM `users` WHERE `uid`=$data[0]";
	try
	{
		$delete_Run = mysqli_query($conn,$delete_query);

		if ($delete_Run) {
			if (mysqli_affected_rows($conn) > 0) {
				echo "<script type='text/javascript'>alert('Data Deleted');</script>";
		echo"<script>window.open('logout.php','_self')</script>";
			}else{
				echo "Data Not Deleted";
			}
		}
	}catch(Exception $ex){
		echo 'Error Delete'.$ex->getMessage();	
	}
	
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit User Details</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<style type="text/css">
		.head{
			text-align: center;
			color: white;
			font-style: bold;
		}
		.lb{
			color: navy;
			margin-bottom: 10px;
		}
		.form{
			margin-top: 50px;
			background-color: white;
		}
		.form-control{
			text-align: right;
		}
	</style>
</head>
<body>
	<?php
		$query = mysqli_query($conn,"SELECT * FROM users WHERE email='$_SESSION[user_info]' ;");
		$row=mysqli_fetch_assoc($query);
		?>
	<div class="head bg-primary">
		<h1>Edit Your Profile <img src="img/resume.png" style="width:30px;height: 30px;"></h1>
		<hr/>
	</div>
<div class="container">
	<div class="row">
		<div class="col">
		<form class="form" action="eprofile.php" method="post">
			<h6 class="lb">User Id</h6>
			<input class="form-control" type="text" name="uid" id="uid" value="
			<?php echo $row['uid'];?>">
			<b style="float: right;color:green">*You can't update your user id</b><br/>
			<h6 class="lb">User Name</h6>
			<input class="form-control" type="text" name="name" id="name" value="
			<?php echo $row['uname'];?>"><br/>
			<h6 class="lb">Email address</h6>
			<input class="form-control" type="email" name="email" id="email" value="<?php echo $row['email'];?>"> <br/>
			<h6 class="lb">Mobile number</h6>
			<input class="form-control" type="tel" name="mobile" id="mobile" value="<?php echo $row['mobile'];?>">	<br/>
			<center>
			<div style="margin-top:20px;">
				<button class="btn btn-warning" name="update">Update</button>
				<button class="btn btn-primary"  onclick="RefreshPage()">Refresh</button>
				<button class="btn btn-danger" name="delete">Delete Account</button>
			</div>
			<br/>
			<strong>If You Want To Update Profile <a href="upt-profile.php">&nbsp;Click here!</a></strong></center>
		</form>
		</div>
		<div class="col">
			<img src="img/loginback.png">
		</div>
	</div>
</div>
</body>
</html>