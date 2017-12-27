<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
	session_start();
	require_once("../classes/dbo.class.php");
	$q = "select * from categories";
	$res = $db->get($q);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php  require_once("include/header.inc.php") ?>
	<style type="text/css">
			label.error
			{
				display:block;
				color: brown;
				background: url("images/cross.png") no-repeat left center;
				padding-left: 20px;
			}
		</style>
	<script type="text/javascript" src="js/jquery-1.10.2.js"></script>
	<script type="text/javascript" src="js/jquery.validate.js"></script>
	<script type="text/javascript">
			
		$(document).ready(function() {
		
			$("#cat_frm").validate({
				rules: {
					cat_nm: {required: true },
					
				},
				messages:{
					cat_nm: {
						required: "Categories Name is needed."
					},
					
				}
			});
		
		});
		
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
						<form action="process_add_category.php" method="post" id="cat_frm">
							<table align="center">
								<tr>
									<td>
										<b><center class="font_size">Add Category:</b></center>
									</td>
								</tr>
								<tr>
									<td height="10">
									</td>
								</tr>
								<tr>
									<td>
											<input type="text" name="cat_nm" id="cat_nm" />
									</td>
								</tr>
								<tr>
									<td height="50">
									</td>
								</tr>
								<tr>
									<td>
									
										<input type="submit" value="Add">
									</td>
								</tr>
							</table>
						</form>
						<table align="center" width="70%">
								<tr>
									<td height="20"></td>
								</tr>
								<tr>
									<td colspan="4" width="10%">
										<strong><center><b class="font_size">Browse Categories</b></center></strong>
									</td>
								</tr>
								<tr>
									<td height="20"></td>
								</tr>
								<tr>
									<th align="left"><big>No.</big></th>
									<th align="left"><big>Name</big></th>
									<th align="left"><big>Edit</big></th>
									<th align="left"><big>Delete</big></th>
								</tr>
								<?php
									while($row = mysqli_fetch_assoc($res))
									{
										echo '<tr>
												<td>'.$row['cat_id'].'</td>
												<td>'.$row['cat_name'].'</td>
												<td><a href="edit_category.php?cid='.$row["cat_id"].'">Edit</a></td>
												<td><a href="process_delete_category.php?cid='.$row["cat_id"].'">Delete</a></td>
											  </tr>';
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
