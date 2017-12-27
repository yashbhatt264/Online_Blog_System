<?php
		require_once("../classes/dbo.class.php");
		if(empty($_GET))
		{
			header("location:upload.php"); exit;
		}
		if(empty($_GET["bid"]))
		{
			header("location:upload.php");
		}
		$q =" delete from blogs where b_id=".$_GET["bid"];
		$db->dml($q);
		header("location:upload.php");
?>