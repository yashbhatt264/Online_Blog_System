<?php	
	require_once("../classes/dbo.class.php");
	if(empty($_POST)) {header("location:add_category.php"); exit;}
	
	$msg=array();
	
	if(empty($_POST['cat_nm']))
	{
		$msg[]="Name Was Required";
	}
	if(!empty($msg))
	{
		foreach($msg as $a)
		{
			echo '<li>'.$a.'</li>';
		}
		exit;
	}
	
	$q = "insert into categories (cat_name) values('".$_POST["cat_nm"]."')";
	$db->dml($q);
	
	header("location:add_category.php");
?>
