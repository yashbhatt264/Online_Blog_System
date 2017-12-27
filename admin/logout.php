<?php
	session_start();
	unset($_SESSION["adnm"]);
	unset($_SESSION["adpwd"]);
	header("location:../index.php");
?>