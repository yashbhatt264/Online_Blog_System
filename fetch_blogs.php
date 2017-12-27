<?php 
	session_start();
	require_once("classes/dbo.class.php");
	
	// Security
	if( ! isset($_GET["bnm"]) || empty($_GET["bnm"])) { exit; }

	$res = $db->get("select * from blogs where b_title like '%".$_GET["bnm"]."%'");
	
	while($row = mysqli_fetch_assoc($res))
	{
		echo '<tr>
 				<td colspan="3"><h4>'.$row["b_title"].'</h4></td>
 			</tr>
 			<tr>
 				<td width="30%"><img src="admin/uploads/'.$row["b_thumb"].'" width="100" height="100"></td>
 				<td valign="top">
 					'.$row["b_desc"].'
 				</td>
 				<td valign="bottom"><a href="detail.php?bid='.$row["b_id"].'">More</a></td>
 			</tr>
 			<tr><td colspan="3" height="10"></td></tr>
 			<tr><td colspan="3"><hr></td></tr>';
	
	}
	
	