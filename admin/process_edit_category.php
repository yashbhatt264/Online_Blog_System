<?php
	require_once("../classes/dbo.class.php");
	
	if(empty($_POST)) header("location:add_category.php");
	
	$q =" update categories set
			cat_name='".$_POST["cat_nm"]."'
			where cat_id = '".$_POST["cat_edit_id"]."'
			";
	$db->dml($q);
	header("location:add_category.php");
?>