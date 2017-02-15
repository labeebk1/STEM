
<?php
  session_start();
  if(empty($_SESSION['username'])){
    header("Location:login.php");
  }
?>



<html lang="en">


<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
</head>


<body>
  <br>
  <br>
  <h1 style="font-size: 20px; text-align: center;"> <b>STEM Academy Instructor Portal </b></h1>
  <br>

    <nav>
      <ul>
        <li><a href="index.html">Home</a></li>
        <li class="active"><a href="portal.php">Dashboard</a></li>
        <li><a href="calendar.php">Calendar</a></li><!-- <span class="badge">4</span> -->
        <li><a href="portal.php">Messages<span class="badge green">8</span></a></li>
        <li><a href="portal.php">Notifications<span class="badge red">16</span></a></li>


        <?php if ($_SESSION['username'] == labeeb || $_SESSION['username'] == m_mcmillan || $_SESSION['username'] == aziz || $_SESSION['username'] == aman): ?>
          <li><a href="settings.php">Settings</a></li><!-- <span class="badge yellow">15</span> -->
        <?php endif ?>


        <li><a href="logout.php">Logout</a></li> <!-- Destroy session variables once logout is hit. Also implement auto-login? from Login Tab in Index -->
      </ul>
    </nav>




<table cellspacing='0'> <!-- cellspacing='0' is important, must stay -->
  <tr><th>Task Details</th><th>Progress</th><th>Vital Task</th></tr><!-- Table Header -->
    
<tr><td>Create pretty table design</td><td>100%</td><td>Yes</td></tr><!-- Table Row -->
  <tr class='even'><td>Take the dog for a walk</td><td>100%</td><td>Yes</td></tr><!-- Darker Table Row -->

  <tr><td>Waste half the day on Twitter</td><td>20%</td><td>No</td></tr>
  <tr class='even'><td>Feel inferior after viewing Dribble</td><td>80%</td><td>No</td></tr>
  
    <tr><td>Wince at "to do" list</td><td>100%</td><td>Yes</td></tr>
  <tr class='even'><td>Vow to complete personal project</td><td>23%</td><td>yes</td></tr>

  <tr><td>Procrastinate</td><td>80%</td><td>No</td></tr>
    <tr class='even'><td><a href="#yep-iit-doesnt-exist">Hyperlink Example</a></td><td>80%</td><td><a href="#inexistent-id">Another</a></td></tr>
</table>




  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</body>

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

</html>
