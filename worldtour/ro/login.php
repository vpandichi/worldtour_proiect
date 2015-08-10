<?php include('core/init.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>worldtour | logare</title>
	<link rel="stylesheet" href="styles/login.css">
	<?php if (logged_in() === true) { ?> <!-- daca userul este logat se doreste schimbarea css-ului -->
		<link rel="stylesheet" href="styles/loggedin.css">
	<?php include('loggedin.php'); ?>
	<?php } ?>
</head>
<body>
	<div id="body_wrap">
		<nav id="nav">
			<ul>
				<li><a href="recom.php">recomandari</a></li>
				<li><a href="blog.php">blog</a></li>
				<li><a href="index.php#contact">contact</a></li>
				<li>
					<?php 
						if (logged_in() === true) {
							echo "<a href='includes/logout.php'>delogare</a>";
						} else {
							echo "<a href='login.php'>logare</a>";
							echo "</li><li><a href='register.php'>inregistrare</a>";
						}
					?>	
				</li>
				<li><a href="../en/login.php">en</a></li>
			</ul>
			<div id="logo"><a href="index.php"><img src="img/provisory-logo.gif"></a></div>
		</nav>

		<div id="login_box">
			<h1 class="loreg">Logare</h1>
			<form action='process_login.php' method='post' id='contact_form'>
				<input type='text' name='username' placeholder='nume utilizator... *' id='email' maxlength='60'><br>
				<input type='password' name='password' placeholder='parola... *' id='password' maxlength='33'><br>
				<input type='submit' name='login' class='button' value='logare' id='login' >
				<input type='reset' name='reset' class='button' value='anulare' id='cancel'>
			</form>
		</div>

<?php include('includes/footer.php');  ?>
