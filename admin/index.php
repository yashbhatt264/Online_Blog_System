<?php
		session_start();
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

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
		
	</div>
	<!-- end #menu -->
	<div id="page">
		<div id="page-bgtop">
			<div id="page-bgbtm">
				<div id="content">
					<div class="post">
							<div class="login">
									<form action="process_login.php" method="post">
										<table width="50%" border="0" align="center">
											<tr><td align="center" colspan="2"><h2>Login</h2></td></tr>
											<tr><td colspan="2"><br></td></tr>
											<tr>
												<td width="50%" align="right"><b>Username </b></td>
												<td><input type="text" name="admin_nm"></td>
											</tr>
											<tr><td colspan="2"><br></td></tr>
											<tr>
												<td align="right"><b>Password </b></td>
												<td><input type="password" name="admin_pwd"></td>
											</tr>
											<tr><td colspan="2"><br></td></tr>
											<tr>
												<td colspan="2" align="center"><input type="submit" value="Login"></td>
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
					
				</div>-->
				<!-- end #sidebar -->
				<div style="clear: both;">&nbsp;</div>
			</div>
		</div>
	</div>
	<!-- end #page --> 
</div>
<div id="footer">

</div>
<!-- end #footer -->
</body>
</html>
