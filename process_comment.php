<?php
	//print_r($_POST);exit;
	require_once("classes/dbo.class.php");
	session_start();
	if(empty($_POST)) {header("location:detail.php?bid='".$_POST["bid"]."'"); exit;}
	
	$msg=array();
	
	if(!empty($msg))
	{
		foreach($msg as $a)
		{
			echo '<li>'.$a.'</li>';
		}
		exit;
	}
	
	
	$q="insert into comment(com_b_id,com_u_id,com_desc,com_date) values('".$_POST["bid"]."','".$_SESSION["uid"]."','".$_POST["cmt"]."','".date("d M y")."')"; 
	$db->dml($q);
	
	header("location:detail.php?bid=".$_POST["bid"]."");
	
?>