<?php
		require_once("../classes/dbo.class.php");
		if(empty($_GET))
		{
			header("location:feedback.php"); exit;
		}
		if(empty($_GET["cid"]))
		{
			header("location:feedback.php");
		}
		$q =" delete from contact where con_id=".$_GET["cid"];
		$db->dml($q);
		header("location:feedback.php");
?>