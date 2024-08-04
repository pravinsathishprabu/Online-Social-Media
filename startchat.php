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

		if (isset($_GET['auser'])){
			$aid = $_GET['auser'];
			$choose_auser_query = mysqli_query($conn,"SELECT * FROM users WHERE uid='$aid';");
						    	$auser_data=mysqli_fetch_assoc($choose_auser_query);
		}
$curr_uid = $row['uid'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<style type="text/css">
	.au-but-box{
	  max-width: 100%;
	  max-height: 100%;
	  padding: 5px;
	  margin: 0;
	}
	.msg-box{
	  max-height: 80vh;
	  max-width: 100%;
	  padding: 10px;
	  border: 5px solid black;
	  margin: 0;
	  margin-bottom: 10px;
	  margin-top: 10px;
	}
	.type-box{
	  min-height: 50px;
	  max-width: 100%;
	  padding: 10px;
	  border: 1px solid white;
	  background-color:  white;
	  margin-top: 10px;
	}
	.scrollbar{
		float: left;
	    height: 65vh;
		min-width: 100%;
		background: none;
		overflow-x: hidden;
		overflow-y: scroll;
	}
	.force-overflow{
		min-height: 1000px;
	}
	</style>
</head>
<body style="background-color: white;" >
	<?php include ('nav.php');?>
	<div class="container" class="mt-4">
		<div class="au-but-box">
		<div>
			<?php
				$au_profile =$auser_data['profile'];
					if ($au_profile==null) {
						echo "&nbsp;&nbsp;&nbsp;<img style='width:50px;height:50px;float:left;' src='img/man2.png'>";
					}
					else{
						echo "&nbsp;&nbsp;&nbsp;<img style='width:50px;height:50px;border-radius:30px;float:left;' src='profile/".$auser_data['profile']."'>";
					}?>
				<b id="auname" style="color:black;float: left;font-size:18px;margin-top: 10px;">&nbsp;&nbsp;<?php echo $auser_data['uname'];?></b>

				<?php
		        $profile = $row['profile'];
		          if ($profile == null) {
		            echo "<a href='profile.php'><img style='width:50px;height:50px;float:right' src='img/man2.png'></a>";

		          }
		          else{
		          echo "<a href='profile.php'><img style='width:50px;height:50px;float:right;border-radius:40px;' src='profile/".$row['profile']."'></a>";
		          }
		      ?>
    </div><br/>
  <div class="msg-box">
    <div id="wrapper">
      <div class="scrollbar" id="style-default">
        <div class="force-overflow">
					<?php
							$chat_query = "SELECT * FROM chat WHERE sender_id='$curr_uid' || receiver_id='$curr_uid'";
		          $chat_row=mysqli_query($conn,$chat_query);
							while ($chat_data = mysqli_fetch_array($chat_row) ) 
							{
							 	$senderid = $chat_data['sender_id'];
							 	$receiverid = $chat_data['receiver_id'];
							 	$time = $chat_data['msg_time'];
							 	if ($curr_uid == $senderid && $aid == $receiverid) 
							 	{
						?>
							 		<br>
							 			<div class="user-msg-but-box" style="float: right;">
							 				<div class="row" style="background-image:linear-gradient(to left,#7070db,#ff33cc);margin-top: 5px;max-width:70%;min-width: 20%;min-height:70%;float:right;border-radius: 5px;margin-right: 10px;">
							 				 <strong style="color: white;text-align:left"><?php echo $chat_data['msg'] ; ?>	</strong>
							 		    <p style="text-align: right;color: #c2c2d6;margin-right: 20px;"><?php echo $time = date("H.i",strtotime($time));?>&#10004;</p>
							 			</div>
							 		</div><br/>
							 		<br>
						<?php
							 	}
							 	else if($curr_uid == $receiverid && $aid == $senderid) 
							 	{
							 		?>
						 		<div class="sender-msg-but-box">
							 				<div class="row" style="background-color:lightseagreen;min-width: 20%;max-width: 70%;max-height:70%;margin-top: 5px;float:left;border-radius: 5px;">
							 				 <strong style="color: white;margin-left: 5px; ;text-align:left"><?php echo $chat_data['msg'] ; ?></strong>
							 		    <p style="text-align: right;color: #c2c2d6;"><?php echo $time = date("H.i",strtotime($time));?></p>
							 			</div>
							 		</div>
							 		<br><br/><br/>
							 	<?php }
					 } ?>
	</div></div></div>
		  	
		  	<div class="row">
		  		<center>
		  			<form action="" method="post">
				  	    <input type="text" name="msg" placeholder="Type something..." style="width:80%;height: 50px;" autocomplete="off">
				  	    <button class="btn btn-primary" style="margin-bottom: 5px;" name="send"><img src="img/post.png" style="width:30px;height:35px;"></button>
				  	    <?php
						if (isset($_POST['send'])) 
						{
							$msg = $_POST['msg'];
							if ($msg != null) 
							{
									$msgquery = "INSERT INTO chat(sender_id,receiver_id,msg) VALUES('$curr_uid','$aid','$msg'); ";
						
						      if (mysqli_query($conn, $msgquery)) 
						      {
									echo "<script>window.open(startchat.php?auser=$aid,'_self')</script>";	
						    	}
									else
							    {
								    echo "not sent";
						      }
						  }
					  }
					?>
		  	    </form>
		  		</center>
		  	</div>
	</div>
	</div>
</body>
</html>