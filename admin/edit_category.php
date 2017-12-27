<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
	require_once("../classes/dbo.class.php");
	if(empty($_GET["cid"]))
	{
		header("location:add_category.php");
		exit;
	}
	
	$q = "select * from categories where cat_id = ".$_GET["cid"];
	$res = $db->get($q);
	$row = mysqli_fetch_assoc($res);
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
						<form action="process_edit_category.php" method="post">
							<input type="hidden" name="cat_edit_id" value="<?php echo $row["cat_id"]?>">
							<table align="center">
								<tr>
									<td>
										Edit Category:
									</td>
								</tr>
								<tr>
									<td height="10">
									</td>
								</tr>
								<tr>
									<td>
											<input type="text" name="cat_nm" value="<?php echo $row["cat_name"]?>"/>
									</td>
								</tr>
								<tr>
									<td height="50">
									</td>
								</tr>
								<tr>
									<td>
									
										<input type="submit" value="Update">
									</td>
								</tr>
							</table>
						</form>
						
							
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
