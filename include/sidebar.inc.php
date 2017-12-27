<?php
	$link = mysqli_connect("localhost","root","","blog") or die(mysqli_error($link));
	$q = "select * from categories ";
	$res = mysqli_query($link,$q) or die(mysqli_error($link));
	
	if(isset($_SESSION["uid"]))
	{
		$pq = "select * from register where reg_id = ".$_SESSION["uid"];
		$pres = mysqli_query($link,$pq);
		$row = mysqli_fetch_assoc($pres);
	}
?><ul>
	<li>
		<?php
			if(isset($_SESSION["uid"]))
			{
				echo '
					<table>
						<tr>
							<td><img src="uploads/'.$row["reg_profile"].'" width="50" height="50" style="border-radius:25px;"></td>
							<td valign="top">Welcome '.$_SESSION["name"].'</td>
						</tr>
					</table>
				 
				';
			}
		?>
	</li>
	<li>
		<h2><span class="cat_icon">Categories</span></h2>
		<ul>
			<?php
				while($row = mysqli_fetch_assoc($res))
				{
					echo '<li><a href="list.php?cid='.$row["cat_id"].'"><span class="list_icon">'.$row["cat_name"].'</span></a></li>';
				}
			?>
			
		</ul>
	</li>
</ul>