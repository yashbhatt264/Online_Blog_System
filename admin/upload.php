<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
	session_start();
	require_once("../classes/dbo.class.php");
	$q = "select * from categories";
	
	$res = $db->get($q);
	
	$blog = "select * from blogs";
	
	$blog_res = $db->get($blog);
	
	
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
		
			$("#upload_frm").validate({
				rules: {
					cat: {required: true },
					title: {required: true },
					desc: {required: true },
					thumb: {required: true },
					bimg: {required: true },
					
				},
				messages:{
					cat: {
						required: "Categories Name is needed."
					},
					title: {
						required: "Title is needed."
					},
					desc: {
						required: "Description is needed."
					},
					thumb: {
						required: "Thumb is needed."
					},
					bimg: {
						required: "Image is needed."
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
						<form action="process_upload.php" method="post" enctype="multipart/form-data" id="upload_frm">
							<table align="center">
							<tr><td colspan="3"><h4><center><b class="font_size">Upload</b></center></h4><br /></td></tr>
								<tr>
									<td>
										Categories:
									</td>
									<td>
										<select name="cat" id="cat">
											<?php
												while($row = mysqli_fetch_assoc($res))
												{
													echo '<option value="'.$row["cat_id"].'">'.$row["cat_name"].'</option>';
												}
											?>
											
										</select><br><br>
									<td>
								</tr>
								<tr>
									<td>
										Title:
									</td>
									<td>
										<input type="text" name="title" id="title" /><br><br>
									</td>
								</tr>
								
								<tr>
									<td>
										Description:
									</td>
									<td>
										<textarea name="desc" id="desc"></textarea><br><br>
									</td>
								</tr>
								<tr>
									<td>
										Thumb:
									</td>
									<td>
										<input type="file" name="thumb" id="thumb" /><br><br>
									</td>
								</tr>
								<tr>
									<td>
										Image:
									</td>
									<td>
										<input type="file" name="img" id="bimg" /><br><br>
									</td>
								</tr>
								<tr>
									<td colspan="2" align="center">
										<input type="submit" value="upload" />
									</td>
								</tr>
							</table>
						</form>
						
							<table align="center" width="70%">
								<tr>
									<td height="20" colspan="4"></td>
								</tr>
								<tr>
									<td colspan="4" width="10%" align="center">
										<strong><b class="font_size">Browse Categories</b></strong>
									</td>
								</tr>
								<tr>
									<td height="20"></td>
								</tr>
								<tr>
									<th align="left"><big>No.</big></th>
									<th align="left"><big>Category</big></th>
									<th align="left"><big>Title</big></th>
									<th align="left"><big>Delete</big></th>
								</tr>
								<?php
										while($row = mysqli_fetch_assoc($blog_res))
										{
												echo '
														<tr>
															<td>'.$row["b_id"].'</td>
															<td>'.$row["b_cat"].'</td>
															<td>'.$row["b_title"].'</td>
															<td><a href="process_delete_upload.php?bid='.$row["b_id"].'">Delete</a></td>
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
