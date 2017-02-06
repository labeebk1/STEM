
<?php
  session_start();
  if(empty($_SESSION['username'])){
	header("refresh: 3; location:login.php");
  }
?>
<html>
Error! You are not logged in. Redirecting in 3 seconds...
</html>