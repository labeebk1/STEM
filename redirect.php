
<?php
  session_start();
  if(empty($_SESSION['username'])){
	header("refresh: 3; location:login.php");
  }
?>

<!DOCTYPE html>
<html>
<body>

<?php
echo "Error! You are not logged in. Redirecting in 3 seconds...";
?> 

</body>
</html>