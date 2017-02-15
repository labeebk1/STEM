
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


      <div class="wrapper">
  
  <div class="table">
    
    <div class="row header">
      <div class="cell">
        Name
      </div>
      <div class="cell">
        Age
      </div>
      <div class="cell">
        Occupation
      </div>
      <div class="cell">
        Location
      </div>
    </div>
    
    <div class="row">
      <div class="cell">
        Luke Peters
      </div>
      <div class="cell">
        25
      </div>
      <div class="cell">
        Freelance Web Developer
      </div>
      <div class="cell">
        Brookline, MA
      </div>
    </div>
    
    <div class="row">
      <div class="cell">
        Joseph Smith
      </div>
      <div class="cell">
        27
      </div>
      <div class="cell">
        Project Manager
      </div>
      <div class="cell">
        Somerville, MA
      </div>
    </div>
    
    <div class="row">
      <div class="cell">
        Maxwell Johnson
      </div>
      <div class="cell">
        26
      </div>
      <div class="cell">
        UX Architect & Designer
      </div>
      <div class="cell">
        Arlington, MA
      </div>
    </div>
    
    <div class="row">
      <div class="cell">
        Harry Harrison
      </div>
      <div class="cell">
        25
      </div>
      <div class="cell">
        Front-End Developer
      </div>
      <div class="cell">
        Boston, MA
      </div>
    </div>
    
  </div>
  
  <div class="table">
    
    <div class="row header green">
      <div class="cell">
        Product
      </div>
      <div class="cell">
        Unit Price
      </div>
      <div class="cell">
        Quantity
      </div>
      <div class="cell">
        Date Sold
      </div>
      <div class="cell">
        Status
      </div>
    </div>
    
    <div class="row">
      <div class="cell">
        Solid oak work table
      </div>
      <div class="cell">
        $800
      </div>
      <div class="cell">
        10
      </div>
      <div class="cell">
        03/15/2014
      </div>
      <div class="cell">
        Waiting for Pickup
      </div>
    </div>
    
    <div class="row">
      <div class="cell">
        Leather iPhone wallet
      </div>
      <div class="cell">
        $45
      </div>
      <div class="cell">
        120
      </div>
      <div class="cell">
        02/28/2014
      </div>
      <div class="cell">
        In Transit
      </div>
    </div>
    
    <div class="row">
      <div class="cell">
        27" Apple Thunderbolt displays
      </div>
      <div class="cell">
        $1000
      </div>
      <div class="cell">
        25
      </div>
      <div class="cell">
        02/10/2014
      </div>
      <div class="cell">
        Delivered
      </div>
    </div>
    
    <div class="row">
      <div class="cell">
        Bose studio headphones
      </div>
      <div class="cell">
        $60
      </div>
      <div class="cell">
        90
      </div>
      <div class="cell">
        01/14/2014
      </div>
      <div class="cell">
        Delivered
      </div>
    </div>
    
  </div>
  
  <div class="table">
    
    <div class="row header blue">
      <div class="cell">
        Username
      </div>
      <div class="cell">
        Email
      </div>
      <div class="cell">
        Password
      </div>
      <div class="cell">
        Active
      </div>
    </div>
    
    <div class="row">
      <div class="cell">
        ninjalug
      </div>
      <div class="cell">
        misterninja@hotmail.com
      </div>
      <div class="cell">
        ************
      </div>
      <div class="cell">
        Yes
      </div>
    </div>
    
    <div class="row">
      <div class="cell">
        jsmith41
      </div>
      <div class="cell">
        joseph.smith@gmail.com
      </div>
      <div class="cell">
        ************
      </div>
      <div class="cell">
        No
      </div>
    </div>
    
    <div class="row">
      <div class="cell">
        1337hax0r15
      </div>
      <div class="cell">
        hackerdude1000@aol.com
      </div>
      <div class="cell">
        ************
      </div>
      <div class="cell">
        Yes
      </div>
    </div>
    
    <div class="row">
      <div class="cell">
        hairyharry19
      </div>
      <div class="cell">
        harryharry@gmail.com
      </div>
      <div class="cell">
        ************
      </div>
      <div class="cell">
        Yes
      </div>
    </div>
    
  </div>
  
</div>



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
