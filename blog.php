<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
	session_start();
	require_once("classes/dbo.class.php");
	
	
	$q = "select * from blogs";
	
	$res = $db->get($q);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php  require_once("include/header.inc.php") ?>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#bgnm").keyup(function() {
				$.ajax({
					url: "fetch_blogs.php",
					data: {
						"bnm"	:$("#bgnm").val(),
					},
					type: "GET",
					success: function(data) {
						$("#res").html(data);
					}
				});
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
						<center><input type="text" id="bgnm" placeholder="Search Blogs"><center>
						<table width="70%" align="center" id="res">
								<?php
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
								?>
							
							<tr><td colspan="3" height="10"></td></tr>
							<tr><td colspan="3"><hr></td></tr>
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
	<?php require_once("include/footer.inc.php"); ?>
</div>
<!-- end #footer -->
</body>
</html>
