<?php session_start();
	require_once("../classes/dbo.class.php");
	
	if(empty($_POST)){header("location:login.php"); exit;}
	$emsg = array();
	
	if(empty($_POST["admin_nm"]))
		$emsg[] = "Admin Id Was Required";
	
	if(empty($_POST["admin_pwd"]))
		$emsg[] = "Password Was Required";
		
	if(!empty($emsg))
	{
		foreach($emsg as $msg)
		{
			echo $msg."<br>";
		}
		exit;
	}
	
	
	$q = "select * from admin where ad_nm = '".$_POST["admin_nm"]."' and ad_pwd = '".$_POST["admin_pwd"]."'";
	
	$res =$db->get($q);

	if(mysqli_num_rows($res) != 0)
	{
		$row = mysqli_fetch_assoc($res);
		$_SESSION["adid"] = $row["ad_id"];
		$_SESSION["adnm"] = $row["ad_nm"];
		$_SESSION["adpwd"] = $row["ad_pwd"];
		header("location:home.php");
	}
	else
	{
		echo "Wrong Data Try Again";
	}
?>