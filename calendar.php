<?php
  session_start();
  if(empty($_SESSION['username'])){
    header("Location:login.php");
  }
  include_once('functions.php'); 
?>




<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  
  <link rel="stylesheet" href="css/style.css">
  <br>
  <br>
  <title> STEM Academy Instructor Portal </title>
  <section class="container">
    <nav>
      <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="portal.php">Dashboard</a></li>
        <li class="active"><a href="calendar.php">Calendar</a></li><!-- <span class="badge">4</span> -->
        <li><a href="portal.php">Messages<span class="badge green">8</span></a></li>
        <li><a href="portal.php">Settings<span class="badge yellow">15</span></a></li>
        <li><a href="portal.php">Notifications<span class="badge red">16</span></a></li>
        <li><a href="logout.php">Logout</a></li> <!-- Destroy session variables once logout is hit. Also implement auto-login? from Login Tab in Index -->
      </ul>
    </nav>


  <script src="jquery.min.js"></script>
  <div id="calendar_div">
    <?php echo getCalender(); ?>  
  </div>
  <br>
  </section>
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
  


</head>
</html>
