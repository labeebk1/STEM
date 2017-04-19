
<?php
  session_start();
  if(empty($_SESSION['username'])){
    header("Location:login.php");
  }  

  include("fusioncharts/fusioncharts.php");
  $hostdb = '35.185.41.223';  
  $userdb = 'root';  
  $passdb = 'nickonly';  
  $namedb = 'STEM'; 
  $dbhandle = new mysqli($hostdb, $userdb, $passdb, $namedb);
   if ($dbhandle->connect_error) {
    exit("There was an error with your connection: ".$dbhandle->connect_error);
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
  <script type="text/javascript" src="fusioncharts/fusioncharts.js"></script>
  <script type="text/javascript" src="fusioncharts/fusioncharts.theme.zune.js"></script>

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

  <div class="container">
      <div class="well form-horizontal" style="color: white;
                                               text-align: center; 
                                               font-size: 16px; 
                                               background-color: white;" >
  <fieldset>
  <legend><b><span style="color: black;">Announcements</span></b></legend>

    <p style="text-align: left; font-size: 14px; color: black;">
      <b>April 9, 2017</b>
      <br>
      <br>
      Welcome to the instructor portal <span class="user"><?= $_SESSION['username'] ?></span>!
      <br>
      <br>
      The website is currently under development. Updates as of recently:
      <br>
      <br>
      <b>Office Space</b>
      <br>
      <br>
      Our office is located at 7025 Tomken Rd near the intersection of Tomken and Derry. The location will be available to use starting April 15. The office hours will be from Monday - Friday from 6 - 9 PM, and Saturday - Sunday from 12 - 9 PM (we will try to host two classes on the weekends). This office will be available for you to use (optionally, of course) for your one on one sessions with your clients. We will be developing a booking application for you to use if you choose to teach on site. More updates to come on this.
      <br>
    </p>

  </fieldset>


  </div>
      </div><!-- /.container -->


  <div class="container" style="overflow: hidden; position: relative;">
      <div class="well form-horizontal" style="color: white;
                                               text-align: center; 
                                               font-size: 16px; 
                                               background-color: white;
                                               display:inline-block; float: left; width: 280px;" >
  <fieldset>

    <legend>
      <b><span style="color: black;">Chart Options</span></b>
    </legend>

    <!-- Chart Settings: Dropdowns for  -->
    <p style="text-align: center; font-size: 14px; color: black;">


<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">

<table class="table-responsive">
  
  <tr>
    <td width="70">
      <label for="display">Display</label>
    </td>
    <td align="right" width="120">
	  <select class="form-control" id="display" name="disp" style="width:100px; text-align: center;">

	  <?php
	  	if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$display = $_POST['disp'];
			if($display == "Days"){
				echo "<option value=\"Days\" selected=\"selected\">Days</option>";
			} else {
				echo "<option value=\"Days\">Days</option>";
			}
			if($display == "Weeks"){
				echo "<option value=\"Weeks\" selected=\"selected\">Weeks</option>";
			} else {
				echo "<option value=\"Weeks\">Weeks</option>";
			}
			if($display == "Months"){
				echo "<option value=\"Months\" selected=\"selected\">Months</option>";
			} else {
				echo "<option value=\"Months\">Months</option>";
			}
		} else {
			echo "<option value=\"Days\">Days</option>";
			echo "<option value=\"Weeks\">Weeks</option>";
			echo "<option value=\"Months\">Months</option>";
		}
	  ?>
      </select>
    </td>
  </tr>


  <tr>
    <td width="70">
      <label for="students">Student</label>
    </td>
    <td align="right" width="120">
	  <select class="form-control" id="students" name="student" style="width:100px; text-align: center;">
      <?php
        $userlogin = $_SESSION['username'];
        if($userlogin == 'labeeb' || $userlogin == 'm_mcmillan' || $userlogin == 'aman' || $userlogin == 'aziz'){
         $result = $dbhandle->query("SELECT distinct student FROM students;");
        } else {
          $result = $dbhandle->query("SELECT student FROM students where username = '".$userlogin."';");
        }

        if($_SERVER["REQUEST_METHOD"] == "POST"){
		    $student = $_POST['student'];
		    if($student == "Total"){
		    	echo "<option value='Total' selected='selected'>Total</option>";
		    } else {
		    	echo "<option value='Total'>Total</option>";
		    }
	        while($results = mysqli_fetch_assoc($result)) {
	       		if($results['student'] == $student){
	          		echo "<option selected='selected' value='".$results['student']."'>".$results['student']."</option>";
	       		} else {
	          		echo "<option value='".$results['student']."'>".$results['student']."</option>";
	       		}
	        }
        } else {
	        echo "<option value='Total'>Total</option>";
	        while($results = mysqli_fetch_assoc($result)) {
	          echo "<option value=".$results['student'].">".$results['student']."</option>";
	        }
        }
      ?>  
      </select>
    </td>
  </tr>

  <tr>
    <td width="70">
      <label for="paid">Paid</label>
    </td>
    <td align="right" width="120">
	  <select class="form-control" id="paid" name="pd" style="width:100px; text-align: center;">
	  <?php
	  	if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$paid = $_POST['pd'];
			if($paid == "Total"){
				echo "<option value=\"Total\" selected=\"selected\">Total</option>";
			} else {
				echo "<option value=\"Total\">Total</option>";
			}
			if($paid == "Unpaid"){
				echo "<option value=\"Unpaid\" selected=\"selected\">Unpaid</option>";
			} else {
				echo "<option value=\"Unpaid\">Unpaid</option>";
			}
			if($paid == "Paid"){
				echo "<option value=\"Paid\" selected=\"selected\">Paid</option>";
			} else {
				echo "<option value=\"Paid\">Paid</option>";
			}
		} else {
			echo "<option value=\"Total\">Total</option>";
			echo "<option value=\"Unpaid\">Unpaid</option>";
			echo "<option value=\"Paid\">Paid</option>";
		}
	  ?>
	  </select>
    </td>
  </tr>


  <?php 
    $userlogin = $_SESSION['username'];
    if($userlogin == 'labeeb' || $userlogin == 'm_mcmillan' || $userlogin == 'aman'){

    	$result = $dbhandle->query("SELECT username FROM users;");
    	echo "
        <th><b>Admin Settings</b></th>
        <tr>
          <td width=\"70\">
      		<label for=\"inst\">Instructor</label>
          </td>
          <td align=\"right\" width=\"120\">
          	<select class=\"form-control\" id=\"inst\" name=\"instructor\" style=\"width:100px; text-align: center;\">";
        if($_SERVER["REQUEST_METHOD"] == "POST"){
        	$instructor = $_POST['instructor'];
        	if($instructor == "Total"){
	      		echo "<option selected='selected' value=\"Total\">Total</option>";
        	} else {
	      		echo "<option value=\"Total\">Total</option>";
        	}
		    while($results = mysqli_fetch_assoc($result)) {
		      if($results['username'] == $instructor){
		      	echo "<option selected='selected' value='".$results['username']."'>".$results['username']."</option>";
		      } else {
		       	echo "<option value='".$results['username']."'>".$results['username']."</option>";
		      }
		    }
	      	echo "</select></td></tr>";
        } else {

	      echo "<option value=\"Total\">Total</option>";
	      while($results = mysqli_fetch_assoc($result)) {
	      	if($results['username'] == $userlogin){
	      		echo "<option selected='selected' value='".$results['username']."'>".$results['username']."</option>";
	      	} else {
	       		echo "<option value='".$results['username']."'>".$results['username']."</option>";
	      	}
	      }
	      echo "</select></td></tr>";

        }


    }
  ?>

</table>
    <br>
    <button type="submit" id="refreshChart" value="Update"/><br>
    </form>
    <br>
    <legend>
    </legend>
    </p>

  </fieldset>


  </div>


  <div class="well form-horizontal" style="color: white;
                                           text-align: center; 
                                           font-size: 16px; 
                                           background-color: white;
                                           display:inline-block; float: right;" >
  <fieldset>

    <p style="text-align: left; font-size: 14px; color: black;">

    <!-- Statistics Chart -->
      <?php

      $userlogin = $_SESSION['username'];

		// collect value of input field
		if ($_SERVER["REQUEST_METHOD"] == "POST") {

		    $display = $_POST['disp']; 
		    $student = $_POST['student'];
		    $paid = $_POST['pd'];
		    $title = "Teaching Hours by Date (";
		    if($userlogin == 'labeeb' || $userlogin == 'm_mcmillan' || $userlogin == 'aman'){
		    	$instructor = $_POST['instructor'];
		    }


      		$strQuery = "SELECT a.Date, b.Hours FROM (
    select curdate() - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY as Date
    from (select 0 as a union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) as a
    cross join (select 0 as a union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) as b
    cross join (select 0 as a union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) as c
) a LEFT JOIN (SELECT date as 'Date', sum(hours) as 'Hours' FROM STEM.events where ";



		    if(!empty($student)){
		    	if($student != "Total"){
		    		$strQuery .= "student = '".$student."' and ";
		 		}
		 		$title .= "Student = ".$student.", ";
		    } else {
		    	$title .= "Student = Total, ";
		    }
		    if(!empty($instructor)){
		    	if($instructor != "Total"){
		    		$strQuery .= "username = '".$instructor."' and ";
		    		$title .= "Instructor = ".$instructor.", ";
		 		}
		    } else {
		    	$strQuery .= "username = '".$userlogin."' and ";
		    }
		    if(!empty($paid)){
		    	if($paid != "Total"){
		    		if($paid == "Paid"){
		    			$strQuery .= "status = 0 ";
		    		} else {
		    			$strQuery .= "status = 1 ";
		    		}
		    	} else {
		    		$strQuery .= "(status = 0 or status = 1) ";
		    	}
		    	$title .= "Paid Status = ".$paid.")";
		    } else {
		    	$strQuery .= "(status = 0 or status = 1) ";
		    	$title .= "Paid Status = Total)";
		    }
		    $strQuery .= "GROUP BY date ORDER BY date) b ON a.Date = b.Date where a.Date between '2017-01-01' and CURDATE() GROUP BY a.Date ORDER BY a.Date";

		} else {
      		
      		$strQuery = "SELECT a.Date, b.Hours FROM (
    select curdate() - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY as Date
    from (select 0 as a union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) as a
    cross join (select 0 as a union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) as b
    cross join (select 0 as a union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) as c
) a LEFT JOIN (SELECT date as 'Date', sum(hours) as 'Hours' FROM STEM.events where username = '".$userlogin."' GROUP BY date ORDER BY date) b ON a.Date = b.Date where a.Date between '2017-01-01' and CURDATE() GROUP BY a.Date ORDER BY a.Date";

      		$title = "Teaching hours by Date";
		}
		

      $result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

      if ($result) {

          $arrData = array(
                "chart" => array(
                    "caption" => $title,
                    "showValues"=> "0",
                    "theme"=> "zune"
                )
            );
          $arrData["data"] = array();


          while($row = mysqli_fetch_array($result)) {
            array_push($arrData["data"], array(
                "label" => $row["Date"],
                "value" => $row["Hours"],
                "link" => ""
                )
            );
          }
          $jsonEncodedData = json_encode($arrData);
          $columnChart = new FusionCharts("column2D", "myFirstChart" , 800, 350, "chart-1", "json", $jsonEncodedData);
          $columnChart->render();
          $dbhandle->close();
      }
      ?>

      <div id="chart-1"><!-- Fusion Charts will render here--></div>

    <br>
    </p>

  </fieldset>


  </div>
      </div><!-- /.container -->





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
