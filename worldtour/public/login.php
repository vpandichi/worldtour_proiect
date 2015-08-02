<?php include('core/init.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Welcome to worldtour! Your free touristic guide based on real experiences.</title>
	<link rel="stylesheet" href="/sites/worldtour/public/styles/login.css">
	<?php if (logged_in() === true) { ?> <!-- daca userul este logat se doreste schimbarea css-ului -->
		<link rel="stylesheet" href="/sites/worldtour/public/styles/loggedin.css">
	<?php include('loggedin.php'); ?>
	<?php } ?>
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

		<div id="login_box">
			<h1 class="loreg">Log in</h1>
			<form action='process_login.php' method='post' id='contact_form'>
				<input type='text' name='username' placeholder='username... *' id='email' maxlength='60'><br>
				<input type='password' name='password' placeholder='password... *' id='password' maxlength='33'><br>
				<input type='submit' name='login' class='button' value='log in' id='login' >
				<input type='reset' name='reset' class='button' value='cancel' id='cancel'>
			</form>
		</div>

<?php include('includes/footer.php');  ?>
