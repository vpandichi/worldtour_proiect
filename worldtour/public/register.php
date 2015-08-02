<?php 
	include('core/init.php'); 

	if (empty($_POST) === false) {
		$required_fields = array('', '', '', '', '');
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Welcome to worldtour! Your free touristic guide based on real experiences.</title>
	<link rel="stylesheet" href="/sites/worldtour/public/styles/login.css">
</head>
<body>
	<div id="body_wrap">
		<nav id="nav">
			<ul>
				<li><a href="recom.php">recommendations</a></li>
				<li><a href="blog.php">blog</a></li>
				<li><a href="index.php#contact">contact</a></li>
				<li>
					<?php 
						if (logged_in() === true) {
							echo "<a href='includes/logout.php'>log out</a>";
						} else {
							echo "<a href='login.php'>log in</a>";
							echo "</li><li><a href='register.php'>register</a>";
						}
					?>	
				</li>
				<li><a href="/sites/worldtour/ro/public/login.php">ro</a></li>
			</ul>
			<div id="logo"><a href="index.php"><img src="/sites/worldtour/public/img/provisory-logo.gif"></a></div>
		</nav>

	<div id="register_box">
		<h1 class="loreg">Register</h1>
		<form action="" method="post" id="contact_form">
			<input type="text" name="username" placeholder="username... *" id="username"><br>
			<input type="password" name="password" placeholder="password... *" id="password"><br>
			<input type="password" name="password_again" placeholder="password check... *" id="password2"><br>
			<input type="text" name="first_name" placeholder="First name... *" id="fname">
			<input type="text" name="last_name" placeholder="Last name... " id="lname">
			<input type="text" name="email" placeholder="email... *" id="email"><br>
			<input type="submit" name="register" class="button" value="register" id="register">
			<input type="reset" class="button" value="clear all" id="clear">
		</form>
	</div>

<?php include 'includes/footer.php'; ?>
