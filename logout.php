<?php
	session_start();
	unset($_SESSION["uid"]);
	unset($_SESSION["unm"]);
	unset($_SESSION["pwd"]);
	unset($_SESSION["name"]);
	
	header("location:index.php");
?>