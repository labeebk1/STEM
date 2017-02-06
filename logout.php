<?php

	session_unset($_SESSION['username']);
	session_destroy();
	header("location:index.html");
	
?>