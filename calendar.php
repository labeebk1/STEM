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
  <title>Instructor Portal</title>
  <link rel="stylesheet" href="css/style.css">
  <br>
  <p style="text-align: center; font-size: 20px;"> STEM Academy Instructor Portal </p>
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
  </section>
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>

<script src="jquery.min.js"></script>
<div id="calendar_div">
  <?php echo getCalender(); ?>
</div>
  <p style="text-align:center;">
      <b>Welcome to the instructor portal! <span class="user"><?= $_SESSION['username'] ?></span></b>
  </p>

  <!--
  <section class="about">
    <p class="about-links">
      <a href="http://www.cssflow.com/snippets/menu-with-notification-badges" target="_parent">View Article</a>
      <a href="http://www.cssflow.com/snippets/menu-with-notification-badges.zip" target="_parent">Download</a>
    </p>
    <p class="about-author">
      &copy; 2016&ndash;2017 <a href="portal.php" target="_blank">STEM Academy</a> -
      <a href="http://www.cssflow.com/mit-license" target="_blank">MIT License</a><br>
      Original PSD by <a href="http://www.premiumpixels.com/freebies/menu-notification-badges-psd/" target="_blank">Orman Clark</a>
    </p>
  </section>
  -->
</body>
</html>