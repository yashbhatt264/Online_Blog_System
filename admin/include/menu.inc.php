<ul>
			<li><a href="home.php">Homepage</a></li>
			<li><a href="add_category.php">Add Category</a></li>
			<li><a href="feedback.php">View Feedback</a></li>
			<li><a href="upload.php">Upload</a></li>
			<?php
				if(isset($_SESSION["adid"]))
				{
					echo '<li><a href="logout.php">Logout</a></li>';
				}
			?>
			
		</ul>