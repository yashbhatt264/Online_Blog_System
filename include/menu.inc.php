<ul>
			<li><a href="index.php"><span class="home_icon">Home</span></a></li>
			<?php
				if(isset($_SESSION["uid"]))
				{
					echo '<li><a href="blog.php"><span class="blog_icon">Blog</span></a></li>';
				}
			?>
			<?php
				if(!(isset($_SESSION["uid"])))
				{
					echo '<li><a href="login.php"><span class="login_icon">Login</span></a></li>
						<li><a href="register.php"><span class="reg_icon">Register</span></a></li>
					';
				}
			?>
			
			
			<li><a href="about.php"><span class="about_icon">About</span></a></li>
			<li><a href="contact.php"><span class="contact_icon">Contact</span></a></li>
			<?php
				if(isset($_SESSION["uid"]))
				{
					echo '<li><a href="logout.php"><span class="login_icon">Logout</span></a></li>';
				}
			?>
			
		</ul>