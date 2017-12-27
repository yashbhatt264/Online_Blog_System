<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

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
	<script type="text/javascript" src="js/jquery.validate.js"></script>
	<script type="text/javascript">
			
		$(document).ready(function() {
		
			$("#con_frm").validate({
				rules: {
					nm: {required: true },
					mail: {required: true ,email: true},
					phn: {required: true ,rangelength: [10, 10],digits: true},
					msg: {required: true},
					
				},
				messages:{
					nm: {
						required: "Name is needed."
					},
					mail: {
						required: "Email is needed",
						email: "Give Proper Email"
					},
					phn: {
						required: "Phone is needed",
						rangelength: "Phone must be 10 digits",
						digits: "Please give only numbers for phone"
					},
					msg: {
						required: "Messages is needed."
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
						<div class="contact">
							<center><h2>Contact</h2></center><br><br>
							<form action="process_contact.php" method="post" id="con_frm">
								<table width="100%" border="0" align="right">
									
									<tr>
										<td width="30%" align="right"><b>Name :</b></td>
										<td><input type="text" name="nm" id="nm"></td>
									</tr>
									<tr><td colspan="2"><br></td></tr>
									<tr>
										<td align="right"><b>Email :</b></td>
										<td><input type="text" name="mail" id="mail"></td>
									</tr>
									<tr><td colspan="2"><br></td></tr>
									
									<tr>
										<td width="30%" align="right"><b>Phone No :</b></td>
										<td><input type="text" name="phn" id="phn"></td>
									</tr>
									<tr><td colspan="2"><br></td></tr>
									
									
									<tr>
										<td width="30%" align="right"><b>Message :</b></td>
										<td><textarea cols="25" name="msg" id="msg"></textarea></td>
									</tr>
									<tr><td colspan="2"><br></td></tr>
									<tr>
										<td colspan="2" align="center"><input type="submit" value="Send"></td>
									</tr>
								</table>
							</form>
							<div style="clear: both;">&nbsp;</div>
						</div>
						
						
					</div>
					<div style="clear: both;">&nbsp;</div>
				</div>
				<!-- end #content -->
				<!--<div id="sidebar">
					<?php require_once("include/sidebar.inc.php"); ?>
				</div> -->
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
