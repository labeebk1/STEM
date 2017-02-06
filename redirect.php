
<?php
  session_start();
  if(empty($_SESSION['username'])){
	header("refresh: 3; location:login.php");
  }
?>