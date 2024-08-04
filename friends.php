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
}
?>
<?php
    $query = mysqli_query($conn,"SELECT * FROM users WHERE email='$_SESSION[user_info]' ;");
    $user_row=mysqli_fetch_assoc($query);
?>
<style type="text/css">
	.user
	{
		background-color: #4d88ff;
		width:600px;
		margin-top: 20px;
		border-radius: 7px;
	}
	.users-name{
		background-color: #80ffbf;
		width:600px;
		border-radius: 7px;
		color: black;
	}
.tab {
  width: 600px;
  overflow: hidden;
  border: 1px solid  #ff661a;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: center;
  border: none;
  text-align: center;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}
.but-box{
  width: 700px;
  height: 600px; 
  padding: 10px;
  border: 2px solid gray;
  margin: 0;
  background-color: white;
  margin-top: 10px;
  border-radius: 20px;
  margin-top: 10px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ff9900;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ff661a;
}
/* Style the tab content */
.tabcontent {
  display: none;
  border: 1px solid  #ff661a;
  border-top: none;
  background-color: #4d88ff;
  width:600px;
  border-radius: 10px;
  text-align: center;
}
</style>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>WEBEE | Chat with your friends</title>
</head>
<body style="background-image: url('img/friendsback.png');">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
 <center>
 	<form action="friends.php" method="post" class="user">
 		<img src="img/man.png" style="width:40px;height:40px;margin-top: 30px;">
 		<strong style="color: white;font-size: 20px;font-style:bold"><?php echo $_SESSION['user_info']; ?></strong>
 	</form>
 	<div class="tab">
  <button class="tablinks" onclick="openevt(event, 'friends')"><img src="img/laugh.png" style="width:40px;height:40px;">Friend's</button>
  <button class="tablinks" onclick="openevt(event, 'f_requests')"><img src="img/notifications.png" style="width:40px;height:40px;">Requests</button>
  <button class="tablinks" onclick="openevt(event, 'users')"><img src="img/users.png" style="width:40px;height:40px;">Users</button>
</div>

<div id="friends" class="tabcontent">
  <h3>Friend's</h3>
  <?php
  $fetch_query = "select * from users";
      $run_query= mysqli_query($conn,$fetch_query);
      while ($row = mysqli_fetch_assoc($run_query)){
        ?>
        <form action="friends.php" method="post">
        <h5><?php echo $row['uname'] ?></h5>
        <?php
          echo "<a href='friends.php?uid=".$row['uid']."' class='btn btn-success' >Chat</a>";
            ?>
       
        </form>
        <?php
       
      }
    ?>
</div>

<div id="f_requests" class="tabcontent">
  <h3>Requests</h3> 
</div>

<div id="users" class="tabcontent">
  <h3>Users</h3>
  <hr>
  <?php
		$con=mysqli_connect("localhost","root","","wechat");
		if(!$con){  
			echo "<script type='text/javascript'>alert('Database failed');</script>";
		  	die('Could not connect: '.mysqli_connect_error());  
		}
			
 			$fetch_query = "select * from users";
			$run_query= mysqli_query($con,$fetch_query);
			while ($row = mysqli_fetch_assoc($run_query)){
				echo "<p style='color:white;margin-top:10px;'>".$row['uname']."</p>";
        echo "<p style='color:white;margin-top:10px;'>".$row['uid']."</p>";?>
        <button class="btn btn-success" name="send_btn">Send Request</button>
        <button class="btn btn-danger"  name="cancel_btn">Cancel Request</button>
        <?php
			}
 		?>
 	</hr>
</div>
<script>
function openevt(evt, evtName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(evtName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>
 	</form>
 </center>
 <?php
        if (isset($_GET['uid'])) {
        $senderid = $user_row['uid'];
         $receiverid = $_GET['uid'];
 
    $receiver_query = mysqli_query($conn,"SELECT * FROM users WHERE uid='$receiverid';");
    $receiver_row=mysqli_fetch_assoc($receiver_query);

         $receiver_name = $receiver_row['uname'];
          ?>
          <center>
            <form action="friends.php" method="post" class="chat">
              <div class="but-box">
                <div class="row" style="margin-left: 20px;">
      <?php
          $receiver_profile =$receiver_row['profile'];
          if ($receiver_profile==null) {
            echo "<img style='width:50px;height:50px;' src='img/man2.png'>";

          }
          else{
          echo "<img style='width:40px;height:40px;border-radius:30px;' src='profile/".$receiver_row['profile']."'>";
          }
      ?>
              <strong style="color: black;margin-top: 10px;"><?php echo $receiver_name ?></strong></div>
              <hr style='height:2px;border-width:0;color:gray;background-color:black;'>
              <div class="msg-center">
          
              </div>
              <div class="type_msg" style="margin-top: 480px;">
              <div class="row">
                <input type="text" style="width:80%;margin-left: 30px;" name="msg_text" placeholder="Type here..." autocomplete="off" />
                <button class="btn btn-primary" name="send"><img src="img/post.png" style="width:25px;height: 25px;margin-left: 10px;"></button>
              </div>
            </div>
            </div>
            </form>
       </center>

          <?php
             if (isset($_POST['send'])) {
               $msg = $_POST['msg_text'];
               
               $sid = $row['uid'];
                echo "$receiverid";
                
             }
        }
        ?>
</body>
</html>