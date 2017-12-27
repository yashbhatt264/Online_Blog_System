
<?php
	session_start();
	require_once("classes/dbo.class.php");
	
	if(!isset($_GET["cid"]))
	{
		header("location:index.php");exit;
	}
	$q =" select * from blogs where b_cat=".$_GET["cid"];
	// $res = $db->get($q);
	
	//Pagination
	require_once("classes/paging.class.php");
	$p = new paging($q);
	$res = $p->get_result();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

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
						<table width="100%" border="0">
						<?php
							while($row = mysqli_fetch_assoc($res))
							{
								echo '<tr>
								<td width="20%"><img src="admin/uploads/'.$row["b_image"].'" alt="" width="100" height="100"></td>
								<td><b>'.$row["b_title"].'</b><br></br>
								<p>'.$row["b_desc"].'</p>
								<a href="detail.php?bid='.$row["b_id"].'">more..</a></td>
							</tr>
							<tr><td colspan="2"><hr></td></tr>
							';
							}
						?>
							
						</table>
						<div style="float: left;">
								<?php if($p->has_previous()) { ?>
									<a href="<?php echo $p->previous_link() ?>">Previous</a>
								<?php } else { echo "Previous"; } ?>
							</div>
							<div style="float: right;">
								<?php if($p->has_next()) { ?>
									<a href="<?php echo $p->next_link() ?>">Next</a>
								<?php } else { echo "Next"; } ?>
							</div>
							
							
							<center><?php echo $p->page_links(); ?></center>
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
