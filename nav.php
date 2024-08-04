<?php 
session_start();
error_reporting(0);

$conn = mysqli_connect("localhost","root","","webpro");
if(!$conn){  
  echo "<script type='text/javascript'>alert('Database failed');</script>";
    die('Could not connect: '.mysqli_connect_error());  
}

    $query = mysqli_query($conn,"SELECT * FROM users WHERE email='$_SESSION[user_info]' ;");
    $row=mysqli_fetch_assoc($query);

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
  <script src="bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
<header>
<nav class="navbar navbar-expand-lg bg-primary text-dark" style="background-color: #cc5200;">
  <div class="container-fluid">
    <strong class="nav-item">
      <img src="img/logo.png" style="width: 50px;height: 50px;border-radius: 30px;">
    WEBBEE
    </strong>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="btn btn-light" onclick="myFunction()"><img src="img/menu.png" width="30px" height="30px"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto  mb-lg-0" >
        <li class="nav-item">
          <a class="nav-link text-light active" aria-current="page" href="home.php"> <strong class="nav-options">Home</strong></a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light"  href="redesignpost.php"><strong class="nav-options">Posts</strong></a>
        </li>
         <li class="nav-item">
          <a class="nav-link text-light"  href="chat.php"><strong class="nav-options">Chat</strong></a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="myposts.php"><strong class="nav-options">My Posts</strong></a>
        </li>
        <li class="nav-item ml-2">
          <?php
          $profile =$row['profile'];
            if ($profile==null) {
              echo "<img style='width:50px;height:50px;' src='img/man2.png'>";

            }
            else{
            echo "<img style='width:50px;height:50px;border-radius:2px' src='profile/".$row['profile']."'>";
            }
        ?>
        </li>
         <li class="nav-item">
          <?php  
        if(isset($_SESSION['user_info'])){
          echo '<a href="profile.php" class="text-light btn m-2 bg-dark">Your Profile</a>';
          echo '<A HREF="logout.php" class="text-light btn m-2 bg-danger ml-auto" style="text-decoration:none;">&nbsp;&nbsp;&nbsp;Logout &nbsp;&nbsp;&nbsp;</A>';
        }
        else
          echo '<A HREF="login.php" class="btn btn-light m-1" style="text-decoration:none;">Login</A>';
        ?>
        </li>
      </ul>
      <center>
      
</center>
    </div>
  </div>
</nav>
</header>
</body>
</html>
<script type="text/javascript">
  function myFunction() {
  var x = document.getElementById("navbarSupportedContent");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}
</script>