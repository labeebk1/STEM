
<?php
  session_start();
  if(empty($_SESSION['username'])){ // kick out if name not in admin list
    header("Location:login.php");
  }
  if(!($_SESSION['username'] == labeeb || $_SESSION['username'] == m_mcmillan || $_SESSION['username'] == aziz || $_SESSION['username'] == aman)){ // kick out if name not in admin list
    header("Location:login.php");
  }

  if(isset($_POST['func']) && !empty($_POST['func'])){
  switch($_POST['func']){
    //For Add Event
    case 'addEvent':
      addEvent($_POST['username'],$_POST['student'],$_POST['date']);
      break;
    default:
      break;
    }
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
        <li><a href="portal.php">Dashboard</a></li>
        <li><a href="calendar.php">Calendar</a></li><!-- <span class="badge">4</span> -->
        <li><a href="portal.php">Messages<span class="badge green">8</span></a></li>
        <li><a href="portal.php">Notifications<span class="badge red">16</span></a></li>


        <?php if ($_SESSION['username'] == labeeb || $_SESSION['username'] == m_mcmillan || $_SESSION['username'] == aziz || $_SESSION['username'] == aman): ?>
          <li class="active"><a href="settings.php">Settings</a></li><!-- <span class="badge yellow">15</span> -->
        <?php endif ?>


        <li><a href="logout.php">Logout</a></li> <!-- Destroy session variables once logout is hit. Also implement auto-login? from Login Tab in Index -->
      </ul>
    </nav>



  <div class="container">
      <div class="well form-horizontal" style="color: white;
                                               text-align: center; 
                                               font-size: 17px; 
                                               background-color: white; " >
  <fieldset>

  <p style="text-align: left; font-size: 14px; color: black;">

  <legend><b>Total Unpaid Hours</b></legend>

  <?php
    include 'dbConfig.php';
    $eventListHTML = '';
  
    $userlogin = $_SESSION['username'];
    
    $result = $db->query("SELECT username, student, sum(hours) as hours FROM events WHERE status = '1' GROUP BY username, student");

    if($result->num_rows > 0){
      $eventListHTML = '<div class="table" style="color:black;">';
      $eventListHTML .= '<div class="row header blue">';
      $eventListHTML .= '<div class="cell">Instructor</div>';
      $eventListHTML .= '<div class="cell">Student</div>';
      $eventListHTML .= '<div class="cell">Total Hours</div>';
      $eventListHTML .= '</div>';

      while($row = $result->fetch_assoc()){ 
        $eventListHTML .= '<div class="row">';
        $eventListHTML .= '<div class="cell">'.$row['username'].'</div>';
        $eventListHTML .= '<div class="cell">'.$row['student'].'</div>';
        $eventListHTML .= '<div class="cell">'.$row['hours'].'</div>';
        $eventListHTML .= '</div>';
      }
      $eventListHTML .= '</div>';
    }
    echo $eventListHTML;


  ?>

  </p>
  </fieldset>

  </div>
      </div><!-- /.container -->


  <div class="container">
      <div class="well form-horizontal" style="color: white;
                                               text-align: center; 
                                               font-size: 17px; 
                                               background-color: white;" >
  <fieldset>

  <p style="text-align: left; font-size: 14px; color: black;">

  <legend><b>Total Paid Hours</b></legend>

  <?php
    include 'dbConfig.php';
    $eventListHTML = '';
  
    $userlogin = $_SESSION['username']; // Fix Database for Hours that are added as text
    
    $result = $db->query("SELECT username, student, sum(hours) as hours FROM events WHERE status = '0' GROUP BY username, student");

    if($result->num_rows > 0){
      $eventListHTML = '<div class="table" style="color:black;">';
      $eventListHTML .= '<div class="row header green">';
      $eventListHTML .= '<div class="cell">Instructor</div>';
      $eventListHTML .= '<div class="cell">Student</div>';
      $eventListHTML .= '<div class="cell">Total Hours</div>';
      $eventListHTML .= '</div>';

      while($row = $result->fetch_assoc()){ 
        $eventListHTML .= '<div class="row">';
        $eventListHTML .= '<div class="cell">'.$row['username'].'</div>';
        $eventListHTML .= '<div class="cell">'.$row['student'].'</div>';
        $eventListHTML .= '<div class="cell">'.$row['hours'].'</div>';
        $eventListHTML .= '</div>';
      }
      $eventListHTML .= '</div>';
    }
    echo $eventListHTML;


  ?>

  </p>
  </fieldset>

  </div>
      </div><!-- /.container -->



  <div class="container">
      <div class="well form-horizontal" style="color: white;
                                               text-align: center; 
                                               font-size: 17px; 
                                               background-color: white;" >
  <fieldset>

  <p style="text-align: left; font-size: 14px; color: black;">

  <legend><b>Total Hours</b></legend>

  <?php
    include 'dbConfig.php';
    $eventListHTML = '';
  
    $userlogin = $_SESSION['username'];
    
    $result = $db->query("SELECT username, student, sum(hours) as hours FROM events GROUP BY username, student");

    if($result->num_rows > 0){
      $eventListHTML = '<div class="table" style="color:black;">';
      $eventListHTML .= '<div class="row header">';
      $eventListHTML .= '<div class="cell">Instructor</div>';
      $eventListHTML .= '<div class="cell">Student</div>';
      $eventListHTML .= '<div class="cell">Total Hours</div>';
      $eventListHTML .= '</div>';

      while($row = $result->fetch_assoc()){ 
        $eventListHTML .= '<div class="row">';
        $eventListHTML .= '<div class="cell">'.$row['username'].'</div>';
        $eventListHTML .= '<div class="cell">'.$row['student'].'</div>';
        $eventListHTML .= '<div class="cell">'.$row['hours'].'</div>';
        $eventListHTML .= '</div>';
      }
      $eventListHTML .= '</div>';
    }
    echo $eventListHTML;


  ?>

  </p>
  </fieldset>

  </div>
      </div><!-- /.container -->



  <div class="container">
      <div class="well form-horizontal" style="color: white;
                                               text-align: center; 
                                               font-size: 17px; 
                                               background-color: white;" >
  <fieldset>

  <p style="text-align: left; font-size: 14px; color: black;">

    <legend><b>Add a Student to an Instructor</b></legend>

      Username (Instructor Username):<br>
      <input type="text" id="username" value=""/><br><br> <!-- LK Edit -->
      Student:<br>
      <input type="text" id="student" value=""/> <!-- LK Edit --><br><br>
      Date Started (YYYY-MM-DD):<br>
      <input type="text" id="date" value=""/><br><br>
      <input type="button" id="addEventBtn" value="Add Student"/><br>


    <script src="jquery.min.js"></script>
    <script type="text/javascript">

      $(document).ready(function(){
        $('#addEventBtn').on('click',function(){
          var username = $('#username').val();
          var student = $('#student').val();
          var date = $('#date').val();
          $.ajax({
            type:'POST',
            url:'settings.php',
            data: 'func=addEvent&username='+username+'&student='+student+'&date='+date,
            success:function(msg){
                $('#student').val('');
                $('#username').val('');
                $('#date').val('');
                alert('Request sent.');
            }
          });
        });
      });
    </script>
    <?php
      function addEvent($username,$student,$date){          //Include db configuration file
          include 'dbConfig.php';
          //Insert the event data into database
          $insert = $db->query("INSERT INTO students (`username`,`student`,`date`) VALUES
            ('".$username."','".$student."','".$date."');");
          echo 'ok';
      }
    ?>
    <br>
  </p>
  </fieldset>

  </div>
      </div><!-- /.container -->


  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</body>
</html>
