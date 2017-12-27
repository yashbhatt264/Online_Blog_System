<?php session_start();
	require_once("classes/dbo.class.php");
	if(empty($_POST)){header("location:login.php"); exit;}
	$emsg = array();
	
	if(empty($_POST["unm"]))
		$emsg[] = "User Email Was Required";
	
	if(empty($_POST["pwd"]))
		$emsg[] = "Password Was Required";
		
	if(!empty($emsg))
	{
		foreach($emsg as $msg)
		{
			echo $msg."<br>";
		}
		exit;
	}
	
	
	$q = "select * from register where reg_email = '".$_POST["unm"]."' and reg_pwd = '".$_POST["pwd"]."'";
	
	$res = $db->get($q);

	if(mysqli_num_rows($res) != 0)
	{
		$row = mysqli_fetch_assoc($res);
		$_SESSION["uid"] = $row["reg_id"];
		$_SESSION["unm"] = $row["reg_email"];
		$_SESSION["pwd"] = $row["reg_pwd"];
		$_SESSION["name"] = $row["reg_name"];
		header("location:index.php");
	}
	else
	{
		echo "Wrong Data Try Again";
	}
?>