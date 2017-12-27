<?php
	session_start();
	
	require_once("classes/dbo.class.php");
	$q = "select * from cities order by cty_nm";
	$res = $db->get($q);
	
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

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
		
			$("#reg_frm").validate({
				rules: {
					nm: {required: true },
					mail: {required: true ,email: true},
					pwd: {required: true },
					phn: {required: true ,rangelength: [10, 10],digits: true},
					city: {required: true},
					about: {required: true},
					image: {required: true},
				},
				messages:{
					nm: {
						required: "Name is needed."
					},
					mail: {
						required: "Email is needed",
						email: "Give Proper Email"
					},
					pwd: {
						required: "Password is needed."
					},
					phn: {
						required: "Phone is needed",
						rangelength: "Phone must be 10 digits",
						digits: "Please give only numbers for phone"
					},
					city: {
						required: "City is needed."
					},
					about: {
						required: "About is needed."
					},
					image: {
						required: "Profile Image is needed."
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
						<div class="register">
								<center><h2>Register</h2></center><br><br>
							<form action="process_register.php" method="post" enctype="multipart/form-data" id="reg_frm">
								<table width="100%" border="0" align="center">
									
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
										<td width="30%" align="right"><b>Password :</b></td>
										<td><input type="password" name="pwd" id="pwd"></td>
									</tr>
									<tr><td colspan="2"><br></td></tr>
									<tr>
										<td width="30%" align="right"><b>Phone No :</b></td>
										<td><input type="text" name="phn" id="phn"></td>
									</tr>
									<tr><td colspan="2"><br></td></tr>
									<tr>
										<td width="30%" align="right" name="city" ><b>City :</b></td>
										<td>
											<select style="width:80%" name="city" id="city">
												<?php
													while($row = mysqli_fetch_assoc($res))
													{
														echo '<option value='.$row["cty_nm"].'>'.$row["cty_nm"].'</option>';
													}
												?>
												
											</select>
										</td>
									</tr>
									<tr><td colspan="2"><br></td></tr>
									<tr>
										<td width="30%" align="right"><b>Profile</b></td>
										<td><input type="file" name="profile" id="image"></td>
									</tr>
									<tr><td colspan="2"><br></td></tr>
									<tr>
										<td width="30%" align="right"><b>About :</b></td>
										<td><textarea cols="25" name="about" id="about"></textarea></td>
									</tr>
									<tr><td colspan="2"><br></td></tr>
									<tr>
										<td colspan="2" align="center"><input type="submit" value="Register"></td>
									</tr>
								</table>
							</form>
						</div>
						
					</div>
					<div style="clear: both;">&nbsp;</div>
				</div>
				<!-- end #content -->
				<!--<div id="sidebar">
					<?php require_once("include/sidebar.inc.php"); ?>
				</div>-->
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
