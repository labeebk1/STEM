<?php
    $_SESSION['username'] = NULL;
    unset($_SESSION['username']);
	header("location:index.html");
	exit;
?>