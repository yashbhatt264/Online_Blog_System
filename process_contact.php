<?php
	require_once("classes/dbo.class.php");
	if(empty($_POST)) {header("location:contact.php"); exit;}
	
	$msg=array();
	
	if(empty($_POST['nm']))
	{
		$msg[]="Name Was Required";
	}
	if(empty($_POST['mail']))
	{
		$msg[]="Email Was Required";
	}
	if(empty($_POST['phn']))
	{
		$msg[]="Phone Number Was Required";
	}
	if(empty($_POST['msg']))
	{
		$msg[]="Message Was Required";
	}
	if(!empty($msg))
	{
		foreach($msg as $a)
		{
			echo '<li>'.$a.'</li>';
		}
		exit;
	}
	
	
	$q="insert into contact(con_name,con_email,con_ph,con_msg) values('".$_POST["nm"]."','".$_POST["mail"]."','".$_POST["phn"]."','".$_POST["msg"]."')";
	$db->dml($q);
	
	header("location:contact.php");
?>