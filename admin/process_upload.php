<?php
	require_once("../classes/dbo.class.php");
	
	$msg = array();
	
	if(!empty($_FILES["thumb"]["name"]))
	{
		if($_FILES["thumb"]["error"] != 0)
			$msg[] = "error Uploading Image Try Later";
			
		$path = pathinfo($_FILES["thumb"]["name"]);
		$allowed_ext = array("jpg","jpeg","gif","png");
		
		if( ! in_array(strtolower($path["extension"]),$allowed_ext))
			$msg[] = "Wrong For Image Give Only :".implode(", ",$allowed_ext);
			
			
		$max_size = 2;
		if(($_FILES["thumb"]["size"]) / (1024 * 1024 ) > $max_size)
			$emsg[] = "Image Cannot Exceed".$max_size."MB In Size";
	}
	else
		$msg[] = "Thumb Was Required";
	
	if(! empty($_FILES["img"]["name"]))
	{
		if($_FILES["img"]["error"] != 0 )
			$msg[] = "Error Uploading Images Try Later";
			
		$path = pathinfo($_FILES["img"]["name"]);
		$allowed_ext = array("jpg","jpeg","gif","png");
		
		if( ! in_array(strtolower($path["extension"]),$allowed_ext))
			$msg[] = "Wrong For Image Give Only :".implode(", ",$allowed_ext);
			
			
		$max_size = 2;
		if(($_FILES["img"]["size"]) / (1024 * 1024 ) > $max_size)
			$emsg[] = "Image Cannot Exceed".$max_size."MB In Size";
	}
	else
		$msg[] = "Images Was Required ";
		
	
	// File Upload
	$fnm_thumb="";
	$fnm_image="";
	
	if(! empty($_FILES["thumb"]["name"]))
	{
		$fnm_thumb = time()."_".$_FILES["thumb"]["name"];
		move_uploaded_file($_FILES["thumb"]["tmp_name"] , "uploads/".$fnm_thumb);
	}
	if(! empty($_FILES["img"]["name"]))
	{
		$fnm_image = time()."_".$_FILES["img"]["name"];
		move_uploaded_file($_FILES["img"]["tmp_name"] , "uploads/".$fnm_image);
	}
	
	if(!empty($msg))
	{
		foreach($msg as $err)
		{
			echo '<li>'.$err.'</li>';
		}
		exit;
	}
	
	// Insert Data
	$q = "insert into blogs (b_cat , b_title , b_desc , b_thumb , b_image) values ('".$_POST["cat"]."' , '".$_POST["title"]."' , '".$_POST["desc"]."' , '".$fnm_thumb."' , '".$fnm_image."')";
	$db->dml($q);
	header("location:upload.php");
?>
