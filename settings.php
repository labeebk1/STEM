
<?php
  session_start();
  if(empty($_SESSION['username'])){
    header("Location:login.php");
  }
?>




<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <link rel="stylesheet" href="css/style.css">
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


        <?php if ($_SESSION['username'] == labeeb || $_SESSION['username'] == m_mcmillan): ?>
          <li><a href="settings.php">Settings</a></li><!-- <span class="badge yellow">15</span> -->
        <?php endif ?>


        <li><a href="logout.php">Logout</a></li> <!-- Destroy session variables once logout is hit. Also implement auto-login? from Login Tab in Index -->
      </ul>
    </nav>


  <div class="container">
      <form class="well form-horizontal" action=" " method="post" style="text-align: center; font-size: 17px;" >
  <fieldset>

  <!-- Form Name -->
  <legend><b>Announcements</b></legend>

    <p style="text-align: left; font-size: 18px;">
      <b>February 2, 2017</b>
      <br>
      <br>
      <b>Welcome to STEM Administration <span class="user"><?= $_SESSION['username'] ?></span></b>
    </p>

  </fieldset>

  </form>
  </div>
      </div><!-- /.container -->


  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
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
