<?php
  	session_start();
    $_SESSION['username'] = NULL;
    unset($_SESSION['username']);
	header("location:index.html");
	exit;
?>