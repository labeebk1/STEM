<?php

	session_start();
	$_SESSION['message'] = '';
	$mysqli = new mysqli('35.185.41.223:3307','root','nickonly','users');

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		if($_POST['STEMID'] == 'STEM'){
			
			$username = $mysqli->real_escape_string($_POST['username']);
			$email = $mysqli->real_escape_string($_POST['email']);
			$password = md5($_POST['password']);
			
			$sql = "INSERT INTO STEM.users (username, email, password) VALUES ('$username','$email','$password')";

			if ($mysqli->query($sql) == true){
				$_SESSION['message'] = 'Registration Successful! Added $username to the Instructor Database!';
				header("location: welcome.php");
			} else {
				$_SESSION['message'] = 'User could not be added to the Instructor Database';
    			die('Could not connect: ' . mysql_error());
			}


		} else {
			$_SESSION['message'] = 'Invalid Instructor ID';
		}

	}


?>

<!-- -->


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

<!-- Form Name -->
<legend><b>Instructor Register</b></legend>


		<form class="form" action="register.php" method="post" enctype="multipart/form-data" autocomplete="off" style="text-align: center;">
      	<div class="alert alert-error"><b><?= $_SESSION['message'] ?><b></div>

  		<span class="input-group-addon" style="display:inline-block; width: 150px;"><i class="glyphicon glyphicon-user"></i> <span style="font-size:18px;">Username</span></span>
  		<input name="username" placeholder="Username" class="form-control" type="text" style="display: inline-block; width: 200px; font-size: 18px;" required>
  		<br>
  		<br>
  		<span class="input-group-addon" style="display:inline-block; width: 150px;"><i class="glyphicon glyphicon-user"></i> <span style="font-size:18px;">Email</span></span>
  		<input  name="email" placeholder="Email" class="form-control" type="text" style="display: inline-block; width: 200px; font-size: 18px;" required>
  		<br>
  		<br>
  		<span class="input-group-addon" style="display:inline-block; width: 150px;"><i class="fa fa-key"></i><span style="font-size:18px;"> Password</span></span>
  		<input name="password" placeholder="Password" class="form-control"  type="password" style="display: inline-block; width: 200px; font-size: 18px;" required>
  		<br>
  		<br>
  		<input type="password" style="text-align: center"; placeholder="STEM Instructor ID" name="STEMID" autocomplete="new-password" required />
  		</br>
  		</br>
  		<input type="submit" value="Register" class="btn btn-block btn-primary" style="display:inline-block; width: 270px; font-size: 20px;">





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


