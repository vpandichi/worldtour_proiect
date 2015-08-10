<?php  
	include('core/init.php');
	not_logged_in_redirect();
	admin_protect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Welcome to worldtour! Your free touristic guide based on real experiences.</title>
	<link rel="stylesheet" href="styles/login.css">
</head>
<body>
	<div id="body_wrap">
		<nav id="nav">
		<ul>
			<li><a href="recom.php">recommendations</a></li>
			<li><a href="blog.php">blog</a></li>
			<li><a href="index.php#contact">contact</a></li>
			<li><a href='includes/logout.php'>log out</a></li>
			<li><a href="login.php">profile settings</a></li>	
			<li><a href="../ro/login.php">ro</a></li>
		</ul>
		<div id="logo"><a href="index.php"><img src="img/provisory-logo.gif"></a></div>
	</nav>
	<h2 class="admin">Welcome to the admin page...</h2>
	<div class="inner">
		<ul>
			<li><a href="email_users.php">mass email users</a></li>
			<li><a href="add_user.php">add user</a></li>
			<li><a href="delete_users.php">delete active users</a></li>
			<li><a href="delete_inactive_users.php">delete inactive users</a></li>
		</ul>
	</div>
<?php include('includes/footer.php');  ?>