<?php
	require_once("../classes/dbo.class.php");
	if(empty($_GET))
	{
		header("location:add_category.php");exit;
	}
	if(empty($_GET["cid"]))
	{
		header("location:add_category.php"); exit;
	}
	$q="delete from categories where cat_id=".$_GET["cid"];
	$db->dml($q) ;
	header("location:add_category.php");
?>