<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
	session_start();
	require_once("../classes/dbo.class.php");
	$q="select * from contact";
	$res=$db->get($q);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php  require_once("include/header.inc.php") ?>
</head>
<body>
<div id="wrapper">
	<div id="header-wrapper">
		<div id="header">
			<div id="logo">
				<?php  require_once("include/logo.inc.php") ?>
			</div>
		</div>
	</div>
	<!-- end #header -->
	<div id="menu">
		<?php  require_once("include/menu.inc.php") ?>
	</div>
	<!-- end #menu -->
	<div id="page">
		<div id="page-bgtop">
			<div id="page-bgbtm">
				<div id="content">
					<div class="post">
						<form action="">
							<table width="70%" align="center">
								<tr><td colspan="3"><h4><center><b class="font_size">View Feedback</b></center></h4></td></tr>
								<?php
									while($row=mysqli_fetch_assoc($res))
									{
										echo '<tr>
										 	 <td width="10%">
										 		 <a href="process_delete_feedback.php?cid='.$row["con_id"].'"><img src="images/cross.png"></a><br>
										 	 </td>
										 	 <td width="25%">
										 		 <b>'.$row["con_name"].'</b><br>
										 		 '.$row["con_email"].'<br>
										 		 '.$row["con_ph"].'
										 	 </td>
										 	 <td>
										 		 '.$row["con_msg"].'
										 	 </td>
										  </tr>
										  <tr><td colspan="3"><hr></td></tr>';
								
									}
								?>	
								
							</table>
					</div>
					<div style="clear: both;">&nbsp;</div>
				</div>
				<!-- end #content -->
				<div id="sidebar">
					
				</div>
				<!-- end #sidebar -->
				<div style="clear: both;">&nbsp;</div>
			</div>
		</div>
	</div>
	<!-- end #page --> 
</div>
<div id="footer">
	<?php require_once("include/footer.inc.php"); ?>
</div>
<!-- end #footer -->
</body>
</html>

