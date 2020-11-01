<?php
session_start();


	if(!isset($_SESSION['uname']))
	{
		echo '<script type="text/javascript">alert("Please Login first");window.location.href="login.php";</script>';
		exit();

	}
	else
	{
	header("Location:addvenue.php");
	}
?>