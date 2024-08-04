<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>WEBBEE WELCOME'S YOU</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
	<style type="text/css">
			.mySlides{
				max-width: 80%;
				max-height: 80vh;
			}
	</style>
</head>
<body style="overflow-x: hidden;">
	<?php
		include ('nav.php');
	?>
		<center>
			<h4 class="mt-3">Welcome to Webbee !!! </h4 >
				<span style="font-size: 18px;" class="text-primary">Let's connect friends through Webee</span><br/>
					<section class="container">
					  <img class="mySlides" src="img/2.jpg"/>
					  <img class="mySlides" src="img/3.jpg"/>
					  <img class="mySlides" src="img/4.jpg"/>
					</section>
	  </center>
	  <hr>
		<div class="container">
	  	<div class="row">
	  		<div class="col" style="margin-top: 48px;">
		  	 <center class="border bg-dark text-light p-4">
		      <h4 class="highlight text-primary">Create your account</h4>
				  <p class="div-text">let's start enjoy</p>	
				  <h4 class="highlight text-primary">What's New</h4>
				  <p class="div-text">Easy Chat</p>
					<p class="div-text">New Posts Updates</p>
					<p class="div-text">Share Your Posts</p>
				</center>
	    </div>
	    <div class="col">
	    	<center>
	      <lottie-player src="anime/sign.json"  background="transparent"  speed="1"  style="width: 400px; height: 400px;"  loop  autoplay></lottie-player>
	    </center>
	    </div>
	  </div>
	</div>

<div class='Bottomcontent bg-primary p-4 text-light'>
        <div class='container'>
          <div class="row">
            <div class='col'>
              <strong>Copyright 2022 </strong>
              <p>Pravin Sathishprabu</p><br/>
              <strong>Developed By@</strong><p>Pravin Sathishprabu</p>
            </div>
            <div class='col'> 
                <strong>Email Address</strong><p>pravin592002@gmail.com</p>
              </div>
        </div>
    </div>
			</div>
</body>
</html>
<script>
var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}
  x[myIndex-1].style.display = "block";
  setTimeout(carousel, 3000);
}

</script>