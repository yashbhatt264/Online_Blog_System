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
		$msg[]="Mail Was Required";
	}
	
	if(empty($_POST['pwd']))
	{
		$msg[]="password Was Required";
	}
	
	if(empty($_POST['phn']))
	{
		$msg[]="Phone Number Was Required";
	}
	
	if(isset($_POST['city']) and empty($_POST['city']))
	{
		$msg[]="Select The City";
	}
	
	if(empty($_POST['about']))
	{
		$msg[]="about Was Required";
	}
	
	if(! empty($_FILES["profile"]["name"]))
	{
		if($_FILES["profile"]["error"] != 0 )
			$msg[] = "Error Uploading Images Try Later";
			
		$path = pathinfo($_FILES["profile"]["name"]);
		$allowed_ext = array("jpg","jpeg","gif","png");
		
		if( ! in_array(strtolower($path["extension"]),$allowed_ext))
			$msg[] = "Wrong For Image Give Only :".implode(", ",$allowed_ext);
			
			
		$max_size = 2;
		if(($_FILES["profile"]["size"]) / (1024 * 1024 ) > $max_size)
			$emsg[] = "Image Cannot Exceed".$max_size."MB In Size";
	}
	else
		$msg[] = "Images Was Required ";
	
	
	$fnm_profile="";
	
		if(! empty($_FILES["profile"]["name"]))
	{
		$fnm_profile = time()."_".$_FILES["profile"]["name"];
		move_uploaded_file($_FILES["profile"]["tmp_name"] , "uploads/".$fnm_profile);
	}
	if(!empty($msg))
	{
		foreach($msg as $a)
		{
			echo '<li>'.$a.'</li>';
		}
		exit;
	}
	
	
	$q="insert into register(reg_name,reg_email,reg_pwd,reg_ph,reg_city,reg_about,reg_profile) values('".$_POST["nm"]."','".$_POST["mail"]."','".$_POST["pwd"]."','".$_POST["phn"]."','".$_POST["city"]."','".$_POST["about"]."','".$fnm_profile."')";
	$db->dml($q);
	
	header("location:register.php");
?>