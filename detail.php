<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
	session_start();
	require_once("classes/dbo.class.php");
	
	if(empty($_GET["bid"])){  
		header("location:index.php");
		}
	$q = "select * from blogs where b_id=".$_GET["bid"];
	$res = $db->get($q);
	$row = mysqli_fetch_assoc($res);
	
	//Fetch Comment
	$com_q = "select * from comment,register where com_u_id = reg_id and com_b_id = ".$_GET["bid"];
	$com_res = $db->get($com_q);	
	
	//Voting
	require_once("classes/voting.class.php");
	$v = new voting();
	
	//Rating
	require_once("classes/rating.class.php");
	$r = new rating();
	
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php  require_once("include/header.inc.php") ?>
	<script type="text/javascript">
		function check()
		{
			<?php if(!isset($_SESSION["uid"])) { ?>
				alert("Please First Login After Write Comments");
			<?php } ?>
		}
	</script>
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
						<table width="100"  border="0">
							<tr>
								<td><img src="admin/uploads/<?php echo $row["b_image"];?>"width="600" height="200"></td>
							</tr>
							
							
							
							<tr>
								<td><P><?php echo $row["b_desc"]; ?><p></td>
							</tr>
							
														
							<tr>
							<td colspan="2" align="right">
								 <b class="font_size">Rating</b><br><br>
								<!-- rating -->
									<?php $r->show(); ?>
									
							</td>
							</tr>
							
							
							<tr>
							<td colspan="2" align="right">
								 <b class="font_size">Voting</b><br><br>
								<!-- voting -->
								<?php $v->show(); ?>
							</td>
							</tr>
							<tr>
							
								<td colspan="2" align="">
								
								<form action="process_comment.php" method="post">
									<b class="font_size">Comment<b><br><br>
									<input type="hidden" name="bid" value="<?php echo $row["b_id"]; ?>" >
									<textarea name="cmt" rows="5" cols="100" class="width"></textarea><br /><br />
									<input type="submit" value="Comment" onclick="check();" />
									
								</form>
								
								</td>
							</tr>
							
						</table>
						
						<table width="100%" border="0">
						<tr><td colspan="2" height="50"></td></tr>
						<tr><td colspan="3" align="center"><h3>view comment</h3></td></tr>
						<tr><td colspan="2" height="30"></td></tr>
						
							<?php
								while($com_row = mysqli_fetch_assoc($com_res))
								{
									echo '<tr>
											<td width="15%">
												<img src="uploads/'.$com_row["reg_profile"].'" alt="" height="70" width="70">
											</td>
																				
											<td valign="top">
											<b>'.$com_row["reg_name"].'</b><br>
											<i>'.$com_row["com_desc"].'</i></br>
											<big>Date:'.$com_row["com_date"].'</big>
											</td>
										</tr>';
								}
							?>
						
							
						</table>
						
					</div>
					<div style="clear: both;">&nbsp;</div>
				</div>
				<!-- end #content -->
				<div id="sidebar">
					<?php require_once("include/sidebar.inc.php"); ?>
				</div>
				<!-- end #sidebar -->
				<div style="clear: both;">&nbsp;</div>
			</div>
		</div>
	</div>
	<!-- end #page --> 
</div>
<div id="footer">
	<?php require_once("include/footer.inc.php."); ?>
</div>
<!-- end #footer -->
</body>
</html>
