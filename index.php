<?php
	session_start();
	
	require_once("classes/dbo.class.php");
	
	$q = "select * from categories";
	$res = $db->get($q);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php  require_once("include/header.inc.php") ?>
	<script type="text/javascript" src="js/jssor.js"></script>
	<script type="text/javascript" src="js/jssor.slider.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function ($) {
            var _SlideshowTransitions = [{ $Duration: 1000, $Opacity: 2 } ];

            var options = {
                $SlideDuration: 500,                                
                $DragOrientation: 3,                                
                $AutoPlay: true,                                   
                $AutoPlayInterval: 1000,                           
                $SlideshowOptions: {                               
                    $Class: $JssorSlideshowRunner$,                
                    $Transitions: _SlideshowTransitions,           
                    $TransitionsOrder: 1,                          
                    $ShowLink: true                                
                }
            };

            var jssor_slider1 = new $JssorSlider$("slider1_container", options);

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
					<div id="slider1_container" style="position: relative; width: 600px; height: 300px;">

								<!-- Loading Screen -->
								<div u="loading" style="position: absolute; top: 0px; left: 0px;">
									<div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
										background-color: #000; top: 0px; left: 0px;width: 100%;height:100%;">
									</div>
									<div style="position: absolute; display: block; background: url(../img/loading.gif) no-repeat center center;
										top: 0px; left: 0px;width: 100%;height:100%;">
									</div>
								</div>
	
								<!-- Slides Container -->
								<div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 620px; height: 300px;
									overflow: hidden;">
									<div><img u=image src="images/upload/business/1.jpg" /></div>
									<div><img u=image src="images/upload/education/2.jpg" /></div>
									<div><img u=image src="images/upload/health/1.jpg" /></div>
									<div><img u=image src="images/upload/social/1.jpg" /></div>
								</div>				
					</div>
					<br><br><br>
					<?php
						while($row = mysqli_fetch_assoc($res))
						{
							$bq = "select * from blogs where b_cat = ".$row["cat_id"]." limit 0,5";
							$bres = $db->get($bq);
							echo '
								<div class="post">
									<div id="song_list">
										<h2 class="box1"><span><b><font size="5"><span class="cat_icon">'.$row["cat_name"].'</font></b></span></h2>';
										
											while($brow = mysqli_fetch_assoc($bres))
											{
												echo '
													<p>
														<a href="detail.php?bid='.$brow["b_id"].'"><img src="admin/uploads/'.$brow["b_thumb"].'" width="130" height="130" class="border"></a>
														<span class="collection_title"><a href="detail.php?bid='.$brow["b_id"].'">'.$brow["b_title"].'</a></span>
														
													</p>
												';
											}
										
										
										
										echo '
									</div>
								</div><br class="clear" />
							';
						}
					?>
					
						
					
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
