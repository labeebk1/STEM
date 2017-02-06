<?php


	session_unset();
	session_destroy($_SESSION['username']);
	header("location:index.html");
	exit();

	
?>
<!-- Title -->
<title>STEM Academy</title>

<!-- Imports -->


<!-- JavaScript Code -->
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<script src="https://s3.amazonaws.com/menumaker/menumaker.min.js" type="text/javascript"></script>
<script src="script.js"></script>
<!-- Style Sheets -->
<link rel="stylesheet" href="css/styles.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>




<!-- Website -->
	<h1>STEM Academy</h1>

	<!-- Main Menu -->
	<h2>
	<div id="cssmenu">
	<!-- 	cog 	= Wheel
			user 	= User Male
			List 	= http://fontawesome.io/icons/	-->
		<ul>
		<li><a href="#"><i class="fa fa-fw fa-bars"></i> Menu</a></li>
		<li><a href="index.html"><i class="fa fa-fw fa-home"></i> Home</a></li>
		<li class="active"><a href="login.php"><i class="fa fa-fw fa-user"></i> Login</a></li>
		<!--onclick="openNav()"-->
		<li><a href="contact.html"><i class="fa fa-fw fa-phone"></i> Contact</a></li>
		</ul>
	</div>
	</h2>


<div class="container">
    <form class="well form-horizontal" action=" " method="post" style="text-align: center; font-size: 17px;" >
<fieldset>
	<br>
	<p>You have successfully logged out. Redirecting..</p>
  	<br>
</fieldset>


</form>
</div>
    </div><!-- /.container -->
	</body>



<!-- Footer -->
<footer id="footer">
	<div id="footer-inner">
		<hr>
		<p style="font-size:100%; background-color:transparent; text-decoration:none">&copy; Copyright 2016 - 2017 &#124; STEM Academy &#124; <a href="#">Terms of Use</a> &#124; <a href="#">Contact Us</a></p>
		<div class="clr"></div>
	</div>
</footer>


