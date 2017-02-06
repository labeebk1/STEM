
<?php
  session_start();
  if(empty($_SESSION['username'])){
    exit("Error accessing instructor portal. You are not logged in.");
  }

?>




<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title style="text-align: center; font-size: 20px;">Instructor Portal</title>
  <link rel="stylesheet" href="css/style.css">
  STEM Academy Instructor Portal
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
  <section class="container">
    <nav>
      <ul>
        <li class="active"><a href="portal.php">Dashboard</a></li>
        <li><a href="portal.php">Tasks<span class="badge">4</span></a></li>
        <li><a href="portal.php">Messages<span class="badge green">8</span></a></li>
        <li><a href="portal.php">Settings<span class="badge yellow">15</span></a></li>
        <li><a href="portal.php">Notifications<span class="badge red">16</span></a></li>
        <li><a href="logout.php">Logout</a></li> <!-- Destroy session variables once logout is hit. Also implement auto-login? from Login Tab in Index -->
      </ul>
    </nav>
  </section>

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
