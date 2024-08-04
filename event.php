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
	$post_id = $_GET['pid'];
	$event_query = "SELECT * FROM post WHERE post_id='$post_id'";
	$res_query = mysqli_query($conn,$event_query);
	$res_row=mysqli_fetch_assoc($res_query);
	$curr_uid = $row['uid'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<title>WEBBEE | Like Comment</title>
	<style type="text/css">
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-6" style="min-width:300px;padding: 5px;overflow-x: hidden;">
				<center>
				<?php 
					echo "<img style='border:2px solid black;padding:10px;max-height:90vh;max-width:100%;margin-top:10px;margin-bottom:10px' src='posts/".$res_row['image']."'>";
				?>	
			</center>
			</div><br/>
			<div class="col-md-6" style="margin-top: 5px;">
				<form action="" method="post">
					<center>
					<?php
							$results = mysqli_query($conn, "SELECT * FROM post_likes WHERE user_id=$curr_uid AND postid =$post_id");
							if (mysqli_num_rows($results)){ 
								echo "<button class='btn btn-info'><img src='img/like.png' width='30px' height='30px' ></img></button>";	
							}
							else { ?>
								<button class="btn btn-outline-info" name="like" id="like"><img src="img/like.png" width="30px" height="30px" ></button>
							<?php } ?>

						<strong style="color:black"><?php echo $res_row['likes']; ?> likes</strong></center>
						<?php
							if (isset($_POST['like'])) {
								$id = $post_id;
							    $n = $res_row['likes'];
								$lkquery = "INSERT INTO post_likes(user_id,postid) VALUES('$curr_uid','$id');"; 
							$lkquery .= "UPDATE post SET likes=$n+1 WHERE post_id=$id;"; 
							$run_lkquery = $conn -> multi_query($lkquery);

							if ($run_lkquery) {
								echo "<script>window.open('event.php?pid=$post_id','_self')</script>";
							}
						}
						?><br/>
						<button class="btn form-control btn-warning">Comments</button>
						<div class="msg-box" style="height: 55vh;max-width: 100%;padding: 10px;margin: 0;color: black;margin-top: 10px;border: 2px solid black;background-color: navy;">
							<div id="wrapper">		
							<div class="scrollbar" style="float: left;height: 50vh;min-width:98%;background-color: white;overflow-y: scroll;border: 2px solid black;">
								<div class="force-overflow" style="min-height: 500px;">
									<?php
		        						$getcomment_query = "SELECT * FROM post_comment WHERE post_id = '$post_id'";
		        						$comment_row=mysqli_query($conn,$getcomment_query);
										while ($comment_data = mysqli_fetch_array($comment_row) ) {
										$comment_sender = $comment_data['user_id'];
										$comment_time = $comment_data['cmt_time'];
										$com_sen_query =  "SELECT * FROM users WHERE uid = '$comment_sender'";
										$com_sen_udetails = mysqli_query($conn,$com_sen_query);
										while ($csd_data=mysqli_fetch_array($com_sen_udetails)) {
										?>
								<div class="comment-box" style="background-color: black;color: white;">
									<div style="margin-top: 10px;">
										<?php
										$uname = $csd_data['uname'];
										$cs_profile =$csd_data['profile'];
											if ($cs_profile==null) {
												echo "<img style='width:50px;height:50px;margin-top:5px;' src='img/man2.png'>";
											}
											else{
											echo "<img style='width:35px;height:35px;margin-left:5px;margin-top:5px;border-radius:25px;' src='profile/".$csd_data['profile']."'>";
											}
											?>
											<b style="margin-left: 2px;margin-top:5px;"><?php echo $uname ?></b>

										 <p style="color:blue;margin-left: 80px"><?php echo $comment_data['comment'] ; ?>	</p>&nbsp;&nbsp;
									</div>
								</div>
							<?php } } ?>
								</div>
							</div>
						</div>
						</div>
						<div class="row mt-2" style="margin-left:5px;">
					  	    <input type="text" name="comment" placeholder="Comment here...." style="width:80%;height: 40px;padding: 10px;" autocomplete="off">
					  	    <button class="btn btn-primary" style="width: 15%;" name="sendcomment"><img src="img/post.png" style="width:15px;height:15px;"></button>
					  	    <?php
						if (isset($_POST['sendcomment'])) 
							{
								$comment = $_POST['comment'];
								if ($comment != null) 
								{
									$commentquery = "INSERT INTO post_comment(user_id,post_id,comment) VALUES('$curr_uid','$post_id','$comment'); ";
							
							      if (mysqli_query($conn, $commentquery)) 
							      {
										echo "<script>window.open('event.php?pid=$post_id','_self')</script>";
							    	}
										else
								    {
									    echo "<script>alert('not sent')</script>";
							      }
							  }
						  }?>
		  				</div>
						<script type="text/javascript">
							function opencomment() {
								
							}
						</script>
					</form>
					
			</div>
		</div>
	</div>

</body>
</html>